<?php

namespace App\Http\Controllers;

use App\OutboundStudentChecklist;
use Illuminate\Http\Request;
use App\OutboundStudent;
use App\Http\Requests\OutboundStudentCheckRequest;

class OutboundStudentChecklistController extends Controller
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
     * @param  \App\Http\Requests\OutboundStudentCheckRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutboundStudentCheckRequest $request, OutboundStudent $outboundStudent)
    {
        if ($request->filled('checks')) {
            $outboundStudent->checklist()->sync($request->checks);
            $outboundStudent->save();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OutboundStudentChecklist  $outboundStudentChecklist
     * @return \Illuminate\Http\Response
     */
    public function show(OutboundStudentChecklist $outboundStudentChecklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OutboundStudentChecklist  $outboundStudentChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit(OutboundStudentChecklist $outboundStudentChecklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OutboundStudentChecklist  $outboundStudentChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutboundStudentChecklist $outboundStudentChecklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OutboundStudentChecklist  $outboundStudentChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutboundStudentChecklist $outboundStudentChecklist)
    {
        //
    }
}
