<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;
use App\Visitor;
use App\Http\Requests\GuestStoreRequest;
use App\Http\Requests\GuestUpdateRequest;
class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Visitor $visitor)
    {
        $guests = $visitor->guests;

        return view('guest.index', compact('guests', 'visitor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Visitor $visitor)
    {
        return view('guest.create', compact('visitor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GuestStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestStoreRequest $request)
    {
        $guest = Guest::create($request->all());

        return redirect()->route('guest.index', $guest->visitor_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        return view('guest.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GuestUpdateRequest  $request
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(GuestUpdateRequest $request, Guest $guest)
    {
        $guest->fill($request->all());
        $guest->save();

        return redirect()->route('guest.index', $guest->visitor_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return back();
    }
}
