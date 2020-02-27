<?php

namespace App\Http\Controllers;

use App\Researcher;
use App\Department;
use App\Lecturer;

use Illuminate\Http\Request;

class ResearcherController extends Controller
{
    public function index(Request $request)
    {
        $researcher = Researcher::all();

        return view('researcher.index', compact('researcher'));
    }

    public function create()
    {
        $departments = Department::primitive()->get();

        $lecturers = Lecturer::all();
        return view('researcher.create', compact('departments', 'lecturers'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $researcher = new researcher(
            ['project_id' => $request->get('project_id'),
                'reseacher_id' => $request->get('lecturer'),
                'department_id' => $request->get('department_id'),
                'work_ratio' => $request->get('work_ratio'),
                'OHC' => $request->get('OHC'),
                'note' => $request->get('note')
            ]
        );
        $researcher->save();
        return redirect()->back()->with('success', 'success');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(researcher $researcher)
    {
        return view('researcher.show', compact('researcher'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $researcher = researcher::find($id);
        $departments = Department::primitive()->get();
        $lecturers = Lecturer::all();
        return view('researcher.edit', compact('researcher','departments', 'lecturers'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $researcher = researcher::find($id);
        $researcher->reseacher_id = $request->get('lecturer');
        $researcher->department_id = $request->get('department_id');
        $researcher->work_ratio = $request->get('work_ratio');
        $researcher->OHC = $request->get('OHC');
        $researcher->note = $request->get('note');
        $researcher->save();
        return redirect()->back()->with('success', 'Edit success.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $researcher = researcher::find($id);
        $researcher->delete();
        return redirect()->back()->with('success', 'Delete success');
    }
}
