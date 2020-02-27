<?php

namespace App\Http\Controllers;
use App\Project_installment;
use App\Project;
use Illuminate\Http\Request;

class ProjectInstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        $project_installment = Project_installment::all();
        return view('project-installment.index', compact('project_installment','project'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function request(ActivityStoreRequest $request)
    // {
    //     return DB::transaction(function() use ($request) {
    //         $project_installment = Project_installment::create($request->all());

    //         if ($request->parent == 'project') {
    //             $project_installment->parent()->associate(Project::find($request->project_id));


    //             #$activity->attachment()->save($file);
    //         }

    //         $project_installment->save();

    //         return redirect()->route('project.show', $project_installment);
    //     });
    // }
    public function create()
    {
        return view('project-installment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $project_installment = new project_installment(
            [
                'project_id' =>$request->get('project_id'),
                'no' => $request->get('no'),
                'promised_date' => $request->get('promised_date'),
                'receive_date' => $request->get('receive_date'),
                'fund' => $request->get('fund'),
                'researcher' => $request->get('researcher'),
                'ohc' => $request->get('ohc'),
                'university' => $request->get('university'),
                'faculty' => $request->get('faculty'),
                'department' => $request->get('department'),
                'fee' => $request->get('fee'),
                'advance' => $request->get('advance'),
                'insurance' => $request->get('insurance'),
                'others' => $request->get('others'),
                'notes' => $request->get('notes'),
            ]);
        $project_installment->save();
        return redirect()->back()->with('success', 'success');
        // return redirect()->action('ProjectInstallmentController@index', ['project_id' => $project_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $project_installment = Project_installment::find($id);

        // return view('project-installment.show',compact('project_installment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project_installments = Project_installment::find($id);
        return view('project-installment.edit', compact('project_installments'));
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

        $project_installments =  Project_installment::find($id);
        $project_installments->no = $request->get('no');
        $project_installments->promised_date = $request->get('promised_date');
        $project_installments->receive_date = $request->get('receive_date');
        $project_installments->fund = $request->get('fund');
        $project_installments->researcher = $request->get('researcher');
        $project_installments->ohc = $request->get('ohc');
        $project_installments->university =$request->get('university');
        $project_installments->faculty = $request->get('faculty');
        $project_installments->department = $request->get('department');
        $project_installments->fee = $request->get('fee');
        $project_installments->advance = $request->get('advance');
        $project_installments->insurance = $request->get('insurance');
        $project_installments->others = $request->get('others');
        $project_installments->notes = $request->get('notes');
        $project_installments->save();
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
        $project_installments =  Project_installment::find($id);
         $project_installments->delete();
         return redirect()->back()->with('success', 'Delete success');
    }
}
