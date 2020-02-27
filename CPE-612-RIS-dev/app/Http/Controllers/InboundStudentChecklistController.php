<?php

namespace App\Http\Controllers;

use App\InboundStudentChecklist;
use Illuminate\Http\Request;
use App\InboundStudent;
use App\Http\Requests\InboundStudentCheckRequest;

class InboundStudentChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InboundStudentCheckRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InboundStudentCheckRequest $request, InboundStudent $inboundStudent)
    {
        if ($request->filled('checks')) {
            $inboundStudent->checklist()->sync($request->checks);
            $inboundStudent->save();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InboundStudentChecklist  $inboundStudentChecklist
     * @return \Illuminate\Http\Response
     */
    public function show(InboundStudentChecklist $inboundStudentChecklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InboundStudentChecklist  $inboundStudentChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit(InboundStudentChecklist $inboundStudentChecklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InboundStudentChecklist  $inboundStudentChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InboundStudentChecklist $inboundStudentChecklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InboundStudentChecklist  $inboundStudentChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(InboundStudentChecklist $inboundStudentChecklist)
    {
        //
    }
}
