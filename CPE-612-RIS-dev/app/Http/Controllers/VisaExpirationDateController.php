<?php

namespace App\Http\Controllers;

use App\VisaExpirationDate;
use Illuminate\Http\Request;
use App\Http\Requests\VisaExpirationStoreRequest;

class VisaExpirationDateController extends Controller
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
     * @param  \App\Http\Requests\VisaExpirationStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisaExpirationStoreRequest $request)
    {
        VisaExpirationDate::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VisaExpirationDate  $visaExpirationDate
     * @return \Illuminate\Http\Response
     */
    public function show(VisaExpirationDate $visaExpirationDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VisaExpirationDate  $visaExpirationDate
     * @return \Illuminate\Http\Response
     */
    public function edit(VisaExpirationDate $visaExpirationDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VisaExpirationDate  $visaExpirationDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisaExpirationDate $visaExpirationDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VisaExpirationDate  $visaExpirationDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisaExpirationDate $visaExpiration)
    {
        $visaExpiration->delete();

        return back();
    }
}
