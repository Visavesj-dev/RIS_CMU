<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MouStoreRequest;
use App\Http\Requests\MouIndexRequest;
use App\MouType;
use App\Country;
use App\Department;
use App\Mou;
use App\File;
use App\Partner;
use Carbon\Carbon;

class MouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MouIndexRequest $request)
    {
        $types = MouType::all();
        $departments = Department::all();
        $mous = Mou::orderBy('started_at');

        switch ($request->status) {
            case 'expired':
                $mous = $mous->expired();
                break;
            case 'all':
                break;
            default:
                $mous = $mous->unexpired();
        }

        if ($request->filled('type')) {
            $mous = $mous->whereHas('type', function ($query) use ($request) {
                $query->where('mou_types.id', $request->type);
            });
        }

        if ($request->filled('department')) {
            $mous = $mous->whereHas('departments', function ($query) use ($request) {
                $query->where('departments.id', $request->department);
            });
        }

        if ($request->filled('from') && $request->filled('to')) {
            $mous = $mous->whereBetween('started_at', [$request->from, $request->to])
                         ->orwhereBetween('ended_at', [$request->from, $request->to]);
            
        }

        if ($request->filled('search')) {
            $mous = $mous->where(function ($query) use ($request) {
                $query->where('detail', 'like', '%' . $request->search . '%')
                    ->orWhereHas('partners', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $mous = $mous->get();

        return view('mou.index', compact([
            'types',
            'departments',
            'mous'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = MouType::all();
        $countries = Country::all();
        $departments = Department::primitive()->get();
        $suggestedDepartments = Department::nonPrimitive()->get();
        $partners = Partner::select('name')->distinct()->get();

        return view('mou.create', compact([
            'types',
            'countries',
            'departments',
            'suggestedDepartments',
            'partners'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MouStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MouStoreRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $mou = Mou::create($request->all());

            $mou->type()->associate($request->input('type'));

            $partners = array_map(function ($partner) {
                $country_id = Country::firstOrCreate(['name' => $partner['country']])->id;

                return [
                    'name' => $partner['name'],
                    'country_id' => $country_id,
                ];
            }, $request->input('partners'));

            $mou->partners()->createMany($partners);;

            if ($request->filled('departments')) {
                $mou->departments()->sync($request->input('departments'));
            }

            if ($request->filled('department_custom')) {
                $department = Department::firstOrCreate(['name' => $request->input('department_custom')]);
                $mou->otherDepartment()->associate($department);
            }

            if ($request->hasFile('attachment')) {
                $path = $request->attachment->store('files');
                $file = new File([
                    'name' => $request->attachment->getClientOriginalName(),
                    'path' => $path
                ]);

                $mou->attachment()->save($file);
            }

            $mou->save();

            return redirect()->route('mou.show', $mou);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mou $mou
     * @return \Illuminate\Http\Response
     */
    public function show(Mou $mou)
    {
        return view('mou.show', compact('mou'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mou $mou
     * @return \Illuminate\Http\Response
     */
    public function edit(Mou $mou)
    {
        $types = MouType::all();
        $countries = Country::all();
        $departments = Department::primitive()->get();
        $suggestedDepartments = Department::nonPrimitive()->get();
        $partners = Partner::select('name')->distinct()->get();

        return view('mou.edit', compact([
            'types',
            'countries',
            'departments',
            'suggestedDepartments',
            'partners',
            'mou'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MouStoreRequest $request
     * @param  \App\Mou $mou
     * @return \Illuminate\Http\Response
     */
    public function update(MouStoreRequest $request, Mou $mou)
    {
        return DB::transaction(function () use ($mou, $request) {
            $mou->fill($request->all());

            $mou->type()->associate($request->input('type'));

            $partners = array_map(function ($partner) {
                $country_id = Country::firstOrCreate(['name' => $partner['country']])->id;

                return [
                    'name' => $partner['name'],
                    'country_id' => $country_id,
                ];
            }, $request->input('partners'));

            $mou->partners()->delete();
            $mou->partners()->createMany($partners);;

            if ($request->filled('departments')) {
                $mou->departments()->sync($request->input('departments'));
            }

            if ($request->filled('department_custom')) {
                $department = Department::firstOrCreate(['name' => $request->input('department_custom')]);
                $mou->otherDepartment()->associate($department);
            } else {
                $mou->otherDepartment()->delete();
            }

            if ($request->hasFile('attachment')) {
                if ($mou->attachment()->exists()) {
                    Storage::delete($mou->attachment->path);
                    $mou->attachment()->delete();
                }

                $path = $request->attachment->store('files');
                $file = new File([
                    'name' => $request->attachment->getClientOriginalName(),
                    'path' => $path
                ]);

                $mou->attachment()->save($file);
            }

            $mou->save();

            return redirect()->route('mou.show', $mou);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mou $mou
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mou $mou)
    {
        $mou->departments()->sync([]);
        $mou->partners()->delete();
        if ($mou->attachment()->exists()) {
            Storage::delete($mou->attachment->path);
            $mou->attachment()->delete();
        }

        $mou->delete();

        return redirect()->route('mou.index');
    }

    /**
     * Remew the specified resource from storage.
     *
     * @param  \App\Mou $mou
     * @return \Illuminate\Http\Response
     */
    public function renew(Mou $mou)
    {
        $newMou = $mou->replicate();

        $newMou->started_at = Carbon::today();
        $newMou->ended_at = Carbon::tomorrow();
        $newMou->made_agreement_at = Carbon::today();

        $newMou->push();

        $newMou->partners()->createMany($mou->partners->toArray());
        $newMou->departments()->sync($mou->departments);

        return redirect()->route('mou.edit', $newMou);
    }
}
