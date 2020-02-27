<?php

namespace App\Http\Controllers;

use App\ExtendTime;
use Illuminate\Http\Request;

class ExtendTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extendTimes = ExtendTime::all();
        return view('extend-time.index', compact('extendTimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('extend-time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $extendTime = new extendTime(
            ['date' => $request->get('date'),
                'reason' => $request->get('reason'),
                'note' => $request->get('note'),
                'project_id' => $request->get('project_id'),
            ]);
        $extendTime->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $extendTime = extendTime::find($id);
        return view('extend-time.edit', compact('extendTime'));
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
        $extendTime = extendTime::find($id);
        $extendTime->date = $request->get('date');
        $extendTime->reason = $request->get('reason');
        $extendTime->note = $request->get('note');
        $extendTime->save();
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
        $extendTime = extendTime::find($id);
        $extendTime->delete();
        return redirect()->back()->with('success', 'Delete success');
    }
}
