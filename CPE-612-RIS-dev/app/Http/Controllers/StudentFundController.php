<?php

namespace App\Http\Controllers;

use App\StudentFund;
use Illuminate\Http\Request;
use App\Http\Requests\StudentFundStoreRequest;

class StudentFundController extends Controller
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
     * @param  \App\Http\Requests\StudentFundStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentFundStoreRequest $request)
    {
        StudentFund::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentFund  $studentFund
     * @return \Illuminate\Http\Response
     */
    public function show(StudentFund $studentFund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentFund  $studentFund
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentFund $studentFund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentFund  $studentFund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentFund $studentFund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentFund  $studentFund
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentFund $studentFund)
    {
        $studentFund->delete();

        return back();
    }
}
