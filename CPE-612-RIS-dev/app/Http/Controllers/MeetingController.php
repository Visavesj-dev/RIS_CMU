<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Department;
use App\Lecturer;
use App\Http\Requests\MeetingStoreRequest;
use App\Meeting;
use App\MeetingBudget;
use App\Http\Requests\MeetingIndexRequest;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MeetingIndexRequest $request)
    {
        $departments = Department::primitive()->get();

        $meetings = Meeting::orderBy('id');

        if ($request->filled('status')) {
            switch ($request->status)
            {
                case 'ongoging':
                    $meetings = $meetings->whereNull('closed_at');
                    break;
                case 'concluded':
                    $meetings = $meetings->whereNotNull('closed_at');
                    break;
            }
        }

        if ($request->filled('department')) {
            $meetings = $meetings->where('department_id', $request->department);
        }

        if ($request->filled('search')) {
            $meetings = $meetings->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('meeting_place', 'like', '%' . $request->search . '%')
                    ->orWhere('head_of_project', 'like', '%' . $request->search . '%');
            });
        }

        $meetings = $meetings->get();

        return view('meeting.index', compact([
            'departments', 
            'meetings'
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
        $lecturers = Lecturer::all();

        return view('meeting.create', compact('departments', 'lecturers')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MeetingStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingStoreRequest $request)
    {
        return DB::transaction(function() use ($request) {
            $meeting = Meeting::create($request->all());

            $budgets = collect([
                ['name' => 'เงินรายได้คณะ', 'meeting_id' => $meeting->id],
                ['name' => 'เงินรายได้ภาควิชา', 'meeting_id' => $meeting->id],
                ['name' => 'ค่าลงทะเบียน', 'meeting_id' => $meeting->id],
                ['name' => 'เงินสนับสนุน', 'meeting_id' => $meeting->id]
            ]);
            
            $budgets->each(function ($budget, $key) {
                MeetingBudget::create($budget);
            });

            return redirect()->route('meeting.show', $meeting);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        return view('meeting.show', compact(
            'meeting'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        $departments = Department::primitive()->get();
        $lecturers = Lecturer::all();

        return view('meeting.edit', compact(
            'departments', 
            'lecturers', 
            'meeting'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MeetingStoreRequest  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingStoreRequest $request, Meeting $meeting)
    {
        return DB::transaction(function() use ($request, $meeting) {
            $meeting = $meeting->fill($request->all());
            $meeting->save();

            return redirect()->route('meeting.show', $meeting);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        foreach ($meeting->attachments as $attachment) {
            Storage::delete($attachment->path);
            $attachment->delete();
        }

        $meeting->budgets()->delete();
        $meeting->delete();

        return back();
    }
}

