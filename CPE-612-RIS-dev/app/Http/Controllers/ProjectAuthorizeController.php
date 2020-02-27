<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProjectAuthorizeStoreRequest;
use App\Http\Requests\ProjectAuthorizeIndexRequest;
use App\Act;

use App\ProjectAuthorize;
use App\File;
use App\Authorize;
use Carbon\Carbon;
use App\Authorize_list;
use App\Project;

class ProjectAuthorizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectAuthorizeIndexRequest $request)
    {
        $acts = Act::all();
        $authorize_lists = Authorize_list::all();
        $projectAuthorizes = ProjectAuthorize::orderBy('started_at');
        $projects = Project::all();
        $authorizes = Authorize::all();

        switch ($request->status) {
            case 'expired':
                $projectAuthorizes = $projectAuthorizes->expired();
                break;
            case 'unexpired':
                $projectAuthorizes = $projectAuthorizes->unexpired();
            default:
                break;
        }

        //กรอง search

        if ($request->filled('act')) {
            $projectAuthorizes = $projectAuthorizes->whereHas('act', function ($query) use ($request) {
                $query->where('acts.id', $request->act);
            });
        }

        if ($request->filled('authorize_list')) {
            $projectAuthorizes = $projectAuthorizes->whereHas('authorize_lists', function ($query) use ($request) {
                $query->where('authorize_lists.id', $request->authorize_list);
            });
        }

        if ($request->filled('from') && $request->filled('to')) {
            $projectAuthorizes = $projectAuthorizes->whereBetween('started_at', [$request->from, $request->to])
                         ->orwhereBetween('ended_at', [$request->from, $request->to]);

        }

        $projectAuthorizes = $projectAuthorizes->get();

        return view('project-authorize.index', compact([
            'acts',
            'authorize_lists',
            'projectAuthorizes',
            'projects',
            'authorizes'

        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $acts = Act::all();
        $authorize_lists = Authorize_list::primitive()->get();
        $suggestedAuthorize_lists = Authorize_list::nonPrimitive()->get();
        $authorizes = Authorize::all();
        $authorize_lists = Authorize_list::primitive()->get();
        $suggestedAuthorize_lists = Authorize_list::nonPrimitive()->get();
        $projects = Project::select('id','project_name','started_at','ended_at')->latest()->get();
        $projectAuthorizes = ProjectAuthorize::all();
        $found = false;

        return view('project-authorize.create', compact([
            'acts',
            'authorize_lists',
            'suggestedAuthorize_lists',
            'authorizes',
            'authorize_lists',
            'suggestedAuthorize_lists',
            'projects',
            'projectAuthorizes',
            'found'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectAuthorizeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectAuthorizeStoreRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $projectAuthorize = ProjectAuthorize::create($request->all());

            $projectAuthorize->act()->associate($request->input('act'));

            $authorizes = array_map(function ($authorize) {


                return [
                    'project_id' => $authorize['project_id'],

                ];
            }, $request->input('authorizes'));

            $projectAuthorize->authorizes()->createMany($authorizes);

            if ($request->filled('authorize_lists')) {
                $projectAuthorize->authorize_lists()->sync($request->input('authorize_lists'));
            }

            if ($request->filled('authorize_list_custom')) {
                $authorize_list = Authorize_list::firstOrCreate(['name' => $request->input('authorize_list_custom')]);
                $projectAuthorize->otherAuthorize_list()->associate($authorize_list);
            }

            if ($request->hasFile('attachment')) {
                $path = $request->attachment->store('files');
                $file = new File([
                    'name' => $request->attachment->getClientOriginalName(),
                    'path' => $path
                ]);

                $projectAuthorize->attachment()->save($file);
            }

            $projectAuthorize->save();

            return redirect()->route('project-authorize.show', $projectAuthorize);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectAuthorize $projectAuthorize
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectAuthorize $projectAuthorize)
    {
        $projects = Project::all();
        $authorizes = Authorize::all();

        return view('project-authorize.show', compact(
            'projectAuthorize',
            'projects',
            'authorizes'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectAuthorize $projectAuthorize
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectAuthorize $projectAuthorize)
    {
        $acts = Act::all();
        $authorize_lists = Authorize_list::primitive()->get();
        $suggestedAuthorize_lists = Authorize_list::nonPrimitive()->get();
        $authorizes = Authorize::select('project_id')->distinct()->get();
        $projects = Project::select('id','project_name','started_at','ended_at')->latest()->get();

        return view('project-authorize.edit', compact([
            'acts',
            'authorize_lists',
            'suggestedAuthorize_lists',
            'authorizes',
            'projectAuthorize',
            'projects'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProjectAuthorizeStoreRequest  $request
     * @param  \App\ProjectAuthorize $projectAuthorize
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectAuthorizeStoreRequest $request, ProjectAuthorize $projectAuthorize)
    {
        return DB::transaction(function () use ($projectAuthorize, $request) {
            $projectAuthorize->fill($request->all());

            $projectAuthorize->act()->associate($request->input('act'));

            $authorizes = array_map(function ($authorize) {


                return [
                    'project_id' => $authorize['project_id'],
                ];
            }, $request->input('authorizes'));

            $projectAuthorize->authorizes()->delete();
            $projectAuthorize->authorizes()->createMany($authorizes);

            if ($request->filled('authorize_lists')) {
                $projectAuthorize->authorize_lists()->sync($request->input('authorize_lists'));
            }

            if ($request->filled('authorize_list_custom')) {
                $authorize_list = Authorize_list::firstOrCreate(['name' => $request->input('authorize_list_custom')]);
                $projectAuthorize->otherAuthorize_list()->associate($authorize_list);
            } else {
                $projectAuthorize->otherAuthorize_list()->delete();
            }

            if ($request->hasFile('attachment')) {
                if ($projectAuthorize->attachment()->exists()) {
                    Storage::delete($projectAuthorize->attachment->path);
                    $projectAuthorize->attachment()->delete();
                }

                $path = $request->attachment->store('files');
                $file = new File([
                    'name' => $request->attachment->getClientOriginalName(),
                    'path' => $path
                ]);

                $projectAuthorize->attachment()->save($file);
            }

            $projectAuthorize->save();

            return redirect()->route('project-authorize.show', $projectAuthorize);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectAuthorize $projectAuthorize
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectAuthorize $projectAuthorize)
    {
        $projectAuthorize->authorize_lists()->sync([]);
        $projectAuthorize->authorizes()->delete();
        if ($projectAuthorize->attachment()->exists()) {
            Storage::delete($projectAuthorize->attachment->path);
            $projectAuthorize->attachment()->delete();
        }

        $projectAuthorize->delete();

        return redirect()->route('project-authorize.index');
    }
}
