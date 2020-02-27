<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoaIndexRequest;
use App\Moa;
use App\Mou;
use App\Department;
use App\File;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MoaStoreRequest;
use Illuminate\Support\Facades\Storage;

class MoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MoaIndexRequest $request)
    {
        $departments = Department::all();
        $moas = Moa::orderBy('started_at');

        switch ($request->status) {
            case 'expired':
                $moas = $moas->expired();
                break;
            case 'all':
                break;
            default:
                $moas = $moas->unexpired();
        }

        if ($request->filled('department')) {
            $moas = $moas->whereHas('departments', function ($query) use ($request) {
                $query->where('departments.id', $request->department);
            });
        }

        if ($request->filled('from') && $request->filled('to')) {
            $moas = $moas->whereBetween('started_at', [$request->from, $request->to]);
        }

        if ($request->filled('search')) {
            $moas = $moas->where(function ($query) use ($request) {
                $query->where('detail', 'like', '%' . $request->search . '%')
                    ->orWhere('title', 'like', '%' . $request->search . '%');
            });
        }

        $moas = $moas->get(); 

        return view('moa.index', compact([
            'departments', 
            'moas'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::primitive()->get();
        $suggestedDepartments = Department::nonPrimitive()->get();

        return view('moa.create', compact([
            'departments',
            'suggestedDepartments',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MoaStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoaStoreRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $moa = Moa::create($request->all());
            
            if ($request->filled('mou_id')) {
                $moa->mou = Mou::find($request->mou_id);
            }

            if ($request->filled('departments')) {
                $moa->departments()->sync($request->input('departments'));
            }

            if ($request->filled('department_custom')) {
                $department = Department::firstOrCreate(['name'=>$request->input('department_custom')]);
                $moa->otherDepartment()->associate($department);
            }
            
            if ($request->hasFile('attachment')) {
                $path = $request->attachment->store('files');
                $file = new File([
                    'name' => $request->attachment->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $moa->attachment()->save($file);
            }
            
            $moa->save();

            return redirect()->route('moa.show', $moa);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Moa  $moa
     * @return \Illuminate\Http\Response
     */
    public function show(Moa $moa)
    {
        return view('moa.show', compact('moa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Moa  $moa
     * @return \Illuminate\Http\Response
     */
    public function edit(Moa $moa)
    {
        $departments = Department::primitive()->get();
        $suggestedDepartments = Department::nonPrimitive()->get();

        return view('moa.edit', compact([
            'departments',
            'suggestedDepartments',
            'moa'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moa  $moa
     * @return \Illuminate\Http\Response
     */
    public function update(MoaStoreRequest $request, Moa $moa)
    {
        return DB::transaction(function() use ($moa, $request) {
            $moa->fill($request->all());
            
            if ($request->filled('departments')) {
                $moa->departments()->sync($request->input('departments'));
            }
            
            if ($request->filled('department_custom')) {
                $department = Department::firstOrCreate(['name'=>$request->input('department_custom')]);
                $moa->otherDepartment()->associate($department);
            } else {
                $moa->otherDepartment()->delete();
            }
            
            if ($request->hasFile('attachment')) {
                if ($moa->attachment()->exists()) {
                    Storage::delete($moa->attachment->path);
                    $moa->attachment()->delete();
                }
                
                $path = $request->attachment->store('files');
                $file = new File([
                    'name' => $request->attachment->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $moa->attachment()->save($file);
            }
            
            $moa->save();

            return redirect()->route('moa.show', $moa);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moa  $moa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moa $moa)
    {
        $moa->departments()->sync([]);
        if ($moa->attachment()->exists()) {
            Storage::delete($moa->attachment->path);
            $moa->attachment()->delete();
        }

        $moa->delete();

        return redirect()->route('moa.index');
    }
}
