<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Country;
use App\Visitor;
use App\File;
use App\Http\Requests\VisitorIndexRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VisitorStoreRequest;
use Illuminate\Support\Facades\Storage;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VisitorIndexRequest $request)
    {
        $countries = Country::all();

        $years = Visitor::select(DB::raw('YEAR(visited_at)'))
                        ->orderBy(DB::raw('YEAR(visited_at)'))
                        ->distinct()
                        ->get();
                        
        $visitors = Visitor::orderBy('id');

        if ($request->filled('year')) {
            $visitors = $visitors->whereYear('visited_at', $request->year);
        }

        if ($request->filled('country_id')) {
            $visitors = $visitors->where('country_id', $request->country_id);
        }

        if ($request->filled('search')) {
            $visitors = $visitors->where(function ($query) use ($request) {
                $query->where('university', 'like', '%' . $request->search . '%')
                    ->orWhere('note', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhereHas('country', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $visitors = $visitors->get();

        return view('visitor.index', compact([
            'countries', 
            'visitors',
            'years'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();

        return View('visitor.create' , compact([
            'countries'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorStoreRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $visitor = Visitor::create($request->all());

            $country = Country::firstOrCreate(['name' => $request->country]);
            
            $visitor->country()->associate($country);

            $files = [];

            if ($request->hasFile('attachment_group_photo')) {
                $path = $request->attachment_group_photo->store('files');
                $file = new File([
                    'name' => 'group_photo_' . $request->attachment_group_photo->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_memento')) {
                $path = $request->attachment_memento->store('files');
                $file = new File([
                    'name' => 'memento_' . $request->attachment_memento->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_meeting_summary')) {
                $path = $request->attachment_meeting_summary->store('files');
                $file = new File([
                    'name' => 'meeting_summary_' . $request->attachment_meeting_summary->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_other')) {
                $path = $request->attachment_other->store('files');
                $file = new File([
                    'name' => 'other_' . $request->attachment_other->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            $visitor->attachments()->saveMany($files);

            $visitor->save();
            
            return redirect()->route('visitor.show' , $visitor);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        return view('visitor.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        $countries = Country::all();

        return View('visitor.edit' , compact([
            'visitor',
            'countries'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VisitorStoreRequest  $request
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(VisitorStoreRequest $request, Visitor $visitor)
    {
        return DB::transaction(function() use ($request, $visitor) {
            $visitor = $visitor->fill($request->all());

            $country = Country::firstOrCreate(['name' => $request->country]);
            
            $visitor->country()->associate($country);

            $files = [];

            if ($request->hasFile('attachment_group_photo')) {
                $attachment_group_photo = $visitor->attachment_group_photo();
                if ($attachment_group_photo) {
                    Storage::delete($attachment_group_photo->path);
                    $attachment_group_photo->delete();
                }
                $path = $request->attachment_group_photo->store('files');
                $file = new File([
                    'name' => 'group_photo_' . $request->attachment_group_photo->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_memento')) {
                $attachment_memento = $visitor->attachment_memento();
                if ($attachment_memento) {
                    Storage::delete($attachment_memento->path);
                    $attachment_memento->delete();
                }
                $path = $request->attachment_memento->store('files');
                $file = new File([
                    'name' => 'memento_' . $request->attachment_memento->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_meeting_summary')) {
                $attachment_meeting_summary = $visitor->attachment_meeting_summary();
                if ($attachment_meeting_summary) {
                    Storage::delete($attachment_meeting_summary->path);
                    $attachment_meeting_summary->delete();
                }
                $path = $request->attachment_meeting_summary->store('files');
                $file = new File([
                    'name' => 'meeting_summary_' . $request->attachment_meeting_summary->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            if ($request->hasFile('attachment_other')) {
                $attachment_other = $visitor->attachment_other();
                if ($attachment_other) {
                    Storage::delete($attachment_other->path);
                    $attachment_other->delete();
                }
                $path = $request->attachment_other->store('files');
                $file = new File([
                    'name' => 'other_' . $request->attachment_other->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $files[] = $file;
            }

            $visitor->attachments()->saveMany($files);

            $visitor->save();
            
            return redirect()->route('visitor.show' , $visitor);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        if (!empty($visitor->attachment_group_photo())) {
            Storage::delete($visitor->attachment_group_photo()->path);
            $visitor->attachment_group_photo()->delete();
        }

        if (!empty($visitor->attachment_memento())) {
            Storage::delete($visitor->attachment_memento()->path);
            $visitor->attachment_memento()->delete();
        }

        if (!empty($visitor->attachment_meeting_summary())) {
            Storage::delete($visitor->attachment_meeting_summary()->path);
            $visitor->attachment_meeting_summary()->delete();
        }

        if (!empty($visitor->attachment_other())) {
            Storage::delete($visitor->attachment_other()->path);
            $visitor->attachment_other()->delete();
        }

        $visitor->guests()->delete();

        $visitor->hosts()->delete();

        $visitor->delete();

        return back();
    }
}
