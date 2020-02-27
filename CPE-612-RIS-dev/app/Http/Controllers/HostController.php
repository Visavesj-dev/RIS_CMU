<?php

namespace App\Http\Controllers;

use App\Host;
use App\Visitor;
use App\Http\Requests\HostStoreRequest;
use App\Http\Requests\HostUpdateRequest;
use App\Lecturer;
class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Visitor $visitor)
    {
        $hosts = $visitor->hosts;

        return view('host.index', compact('hosts', 'visitor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Visitor $visitor)
    {
        $lecturers = Lecturer::all();
        
        return view('host.create', compact('visitor', 'lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HostStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HostStoreRequest $request)
    {
        $host = Host::create($request->all());

        return redirect()->route('host.index', $host->visitor_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function edit(Host $host)
    {
        return view('host.edit', compact('host'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HostUpdateRequest  $request
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function update(HostUpdateRequest $request, Host $host)
    {
        $host->fill($request->all());
        $host->save();

        return redirect()->route('host.index', $host->visitor_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Host  $host
     * @return \Illuminate\Http\Response
     */
    public function destroy(Host $host)
    {
        $host->delete();

        return back();
    }
}
