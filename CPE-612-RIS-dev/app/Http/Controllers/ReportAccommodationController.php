<?php

namespace App\Http\Controllers;

use App\ReportAccommodationDate;
use Illuminate\Http\Request;
use App\Http\Requests\ReportAccommodationStoreRequest;

class ReportAccommodationController extends Controller
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
     * @param  \App\Http\Requests\ReportAccommodationStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportAccommodationStoreRequest $request)
    {
        ReportAccommodationDate::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReportAccommodationDate  $reportAccommodationDate
     * @return \Illuminate\Http\Response
     */
    public function show(ReportAccommodationDate $reportAccommodationDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportAccommodationDate  $reportAccommodationDate
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportAccommodationDate $reportAccommodationDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportAccommodationDate  $reportAccommodationDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportAccommodationDate $reportAccommodationDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportAccommodationDate  $reportAccommodationDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportAccommodationDate $accommodation_report)
    {
        $accommodation_report->delete();
        
        return back();
    }
}
