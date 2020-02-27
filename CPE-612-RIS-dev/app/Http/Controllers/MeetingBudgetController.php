<?php

namespace App\Http\Controllers;

use App\MeetingBudget;
use Illuminate\Http\Request;
use App\Meeting;

class MeetingBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Meeting $meeting)
    {
        $budgets = $meeting->budgets;

        return view('meeting-budget.index', compact('budgets', 'meeting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Meeting $meeting)
    {
        return view('meeting-budget.create', compact('meeting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MeetingBudget::create($request->all());

        return redirect()->route('meeting-budget.index', $request->meeting_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MeetingBudget  $meetingBudget
     * @return \Illuminate\Http\Response
     */
    public function show(MeetingBudget $meetingBudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeetingBudget  $meetingBudget
     * @return \Illuminate\Http\Response
     */
    public function edit(MeetingBudget $meetingBudget)
    {
        $budget = $meetingBudget;

        return view('meeting-budget.edit', compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeetingBudget  $meetingBudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeetingBudget $meetingBudget)
    {
        $meetingBudget->fill($request->all());
        $meetingBudget->save();

        return redirect()->route('meeting-budget.index', $meetingBudget->meeting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeetingBudget  $meetingBudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeetingBudget $meetingBudget)
    {
        $meetingBudget->delete();

        return back();
    }
}
