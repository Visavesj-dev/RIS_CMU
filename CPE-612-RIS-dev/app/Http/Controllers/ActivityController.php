<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityIndexRequest;
use App\Department;
use App\Program;
use App\Http\Requests\ActivityCreateRequest;
use App\Http\Requests\ActivityStoreRequest;
use App\Mou;
use App\File;
use Illuminate\Support\Facades\DB;
use App\Moa;
use App\Lecturer;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Request\ActivityIndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(ActivityIndexRequest $request)
    {
        $programs = Department::all();
        $activities = Activity::orderBy('started_at');

        switch ($request->status) {
            case 'expired':
                $activities = $activities->expired();
                break;
            case 'all':
                break;
            default:
                $activities = $activities->unexpired();
        }

        if ($request->filled('from') && $request->filled('to')) {
            $activities = $activities->whereBetween('started_at', [$request->from, $request->to]);
        }

        if ($request->filled('search')) {
            $activities = $activities->where(function ($query) use ($request) {
                $query->where('detail', 'like', '%' . $request->search . '%')
                    ->orWhereHas('lecturer', function ($query) use ($request) {
                        $query->where('fullname', 'like', '%' . $request->search . '%');
                    })
                    ->orWhere('title', 'like', '%' . $request->search . '%');
            });
        }

        $activities = $activities->get(); 

        return view('activity.index', compact([
            'programs',
            'activities'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Http\Requests\ActivityCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(ActivityCreateRequest $request)
    {
        $lecturers = Lecturer::orderBy('major')->orderBy('name')->get();
        $programs = Program::primitive()->get();
        $suggestedPrograms = Program::nonPrimitive()->get();

        return view('activity.create', compact([
            'lecturers',
            'programs',
            'suggestedPrograms'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ActivityStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityStoreRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $activity = Activity::create($request->all());
            
            if ($request->parent == 'mou') {
                $activity->parent()->associate(Mou::find($request->mou_id));
            } else {
                $activity->parent()->associate(Moa::find($request->moa_id));
            }

            $activity->lecturer()->associate(Lecturer::find($request->lecturer_id));

            if ($request->filled('programs')) {
                $activity->programs()->sync($request->input('programs'));
            }

            if ($request->filled('program_custom')) {
                $program = Program::firstOrCreate(['name'=>$request->input('program_custom')]);
                $activity->otherProgram()->associate($program);
            }
            
            if ($request->hasFile('attachment')) {
                $path = $request->attachment->store('files');
                $file = new File([
                    'name' => $request->attachment->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $activity->attachment()->save($file);
            }
            
            $activity->save();

            return redirect()->route('activity.show', $activity);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activity.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $lecturers = Lecturer::orderBy('major')->orderBy('name')->get();
        $programs = Program::primitive()->get();
        $suggestedPrograms = Program::nonPrimitive()->get();

        return view('activity.edit', compact([
            'lecturers',
            'programs',
            'suggestedPrograms',
            'activity'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\ActivityStoreRequest  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityStoreRequest $request, Activity $activity)
    {
        return DB::transaction(function() use ($activity, $request) {
            $activity->fill($request->all());
            
            if ($request->parent == 'mou') {
                $activity->parent()->associate(Mou::find($request->mou_id));
            } else {
                $activity->parent()->associate(Moa::find($request->moa_id));
            }

            $activity->lecturer()->associate(Lecturer::find($request->lecturer_id));

            if ($request->filled('programs')) {
                $activity->programs()->sync($request->input('programs'));
            }
            
            if ($request->filled('program_custom')) {
                $program = Program::firstOrCreate(['name'=>$request->input('program_custom')]);
                $activity->otherProgram()->associate($program);
            } else {
                $activity->otherProgram()->delete();
            }
            
            if ($request->hasFile('attachment')) {
                if ($activity->attachment()->exists()) {
                    Storage::delete($activity->attachment->path);
                    $activity->attachment()->delete();
                }
                
                $path = $request->attachment->store('files');
                $file = new File([
                    'name' => $request->attachment->getClientOriginalName(),
                    'path' => $path
                ]);
                    
                $activity->attachment()->save($file);
            }
            
            $activity->save();

            return redirect()->route('activity.show', $activity);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->programs()->sync([]);
        if ($activity->attachment()->exists()) {
            Storage::delete($activity->attachment->path);
            $activity->attachment()->delete();
        }

        $activity->delete();

        return back();
    }
}
