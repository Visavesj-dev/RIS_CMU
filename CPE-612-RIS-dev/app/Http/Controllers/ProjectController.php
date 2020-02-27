<?php

namespace App\Http\Controllers;


use App\Project;
use App\Authorize;
use App\ProjectAuthorize;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProjectIndexRequest;
use App\ProjectType;
use App\StrategyType;
use App\FundType;
use App\ProjectStatus;
use App\o_h_c_types;
use App\Department;
use App\Lecturer;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectIndexRequest $request)
    {
        $projectss = Project::orderBy('started_at');
        $authorizes = Authorize::all();
        $projectAuthorizes = ProjectAuthorize::all();

        switch ($request->status) {
            case 'expired':
                $projectss = $projectss->expired();
                break;
            case 'unexpired':
                $projectss = $projectss->unexpired();
            default:
                break;
        }

        if ($request->filled('from') && $request->filled('to')) {
            $projectss = $projectss->whereBetween('started_at', [$request->from, $request->to])
                         ->orwhereBetween('ended_at', [$request->from, $request->to]);

        }

        $projectss = $projectss->get();

        return view('project.index',compact('projectss', 'authorizes', 'projectAuthorizes'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $Projects = Project::all();
        $ProjectTypes = ProjectType::all();
        $StrategyTypes = StrategyType::all();
        $FundTypes = FundType::all();
        $ProjectStatus = ProjectStatus::all();
        $OHCtypes =o_h_c_types::all();
        $departments = Department::primitive()->get();
        $lecturers = Lecturer::all();


        return view('project.create',compact(
            'Projects',
            'ProjectTypes',
            'StrategyTypes',
            'FundTypes',
            'ProjectStatus',
            'OHCtypes',
            'departments',
            'lecturers'



        ));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projects = new project(

            [
                'project_name' => $request->get('project_name'),
                'project_type' => $request->get('project_type'),

                'strategy_type' => $request->get('strategy_type'),
                'cmu_mis_code' => $request->get('cmu_mis_code'),
                'fund_type' => $request->get('fund_type'),
                'fund_source' => $request->get('fund_source'),
                'started_at' => $request->get('started_at'),
                'ended_at' => $request->get('ended_at'),
                'fund_giver_name' => $request->get('fund_giver_name'),
                'fund_giver_address' => $request->get('fund_giver_address'),
                'receipt_list' => $request->get('receipt_list'),
                'percent_OHC' => $request->get('percent_OHC'),
                'all_money_project' => $request->get('all_money_project'),
                'all_OHC' => $request->get('all_OHC'),
                //'period_calculation' => $request->get('period_calculation'),
                'project_status' => $request->get('project_status'),
                'head_project' => $request->get('head_project'),
                'department_subject' => $request->get('department_subject'),
                //'researcher' => $request->get('researcher'),
                'OHC_type' => $request->get('OHC_type'),
                'cmu' => $request->get('cmu'),
                'faculty' => $request->get('faculty'),
                'department' => $request->get('department'),
                'reason' => $request->get('reason'),
                // 'present_fund' => $request->get('present_fund'),
                // 'accept_fund' => $request->get('accept_fund'),
                // 'time_no' => $request->get('time_no'),
                // 'end_time' => $request->get('end_time'),
                'close_project' => $request->get('close_project'),
                'result_project' => $request->get('result_project'),
                'result_detail' => $request->get('result_detail'),

            ]);

        $projects->save();
        $id = $projects->id;

        return redirect()->action('ProjectController@show',['id'=>$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $projectss = Project::find($id);
        $Authorizes = Authorize::find($id);
        $StrategyTypes = StrategyType::all();
        $FundTypes = FundType::all();
        $ProjectStatus = ProjectStatus::all();
        $OHCtypes =o_h_c_types::all();
        $departments = Department::primitive()->get();
        $lecturers = Lecturer::all();
        $count = DB::table('projects')->join('project_installments','projects.id','=','project_installments.project_id')->select('project_installments.project_id')->where("project_installments.project_id","=",$id)->count();
        $query_highest = DB::table('projects')->join('project_installments','projects.id','=','project_installments.project_id')->where("project_installments.project_id","=",$id)->max('project_installments.id');
        $query_date = DB::table('projects')->join('project_installments','projects.id','=','project_installments.project_id')->select('project_installments.receive_date')->where('project_installments.id','=',$query_highest)->max('receive_date');
        $count_lecturer = DB::table('projects')->join('researchers','projects.id','=','researchers.project_id')->select('researchers.project_id')->where("researchers.project_id","=",$id)->count(); 


        return view('project.show',compact('projectss', 'Authorizes','count','query_date','query_highest','count_lecturer'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectss = Project::find($id);
        $ProjectTypes = ProjectType::all();
        $StrategyTypes = StrategyType::all();
        $FundTypes = FundType::all();
        $ProjectStatus = ProjectStatus::all();
        $OHCtypes =o_h_c_types::all();
        $departments = Department::primitive()->get();
        $lecturers = Lecturer::all();

        return view('project.edit',compact(
            'projectss',
            'ProjectTypes',
            'StrategyTypes',
            'FundTypes',
            'ProjectStatus',
            'OHCtypes',
            'departments',
            'lecturers'
        ));
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
        $projectss = Project::find($id);

        // $StrategyTypes = StrategyType::find($id);
        // $FundTypes = FundType::find($id);
        // $ProjectStatus = ProjectStatus::find($id);
        // $OHCtypes =o_h_c_types::find($id);

        // $lecturers = Lecturer::find($id);

        $projectss->project_name = $request->get('project_name');
        $projectss->project_type = $request->get('project_type');
        $projectss->strategy_type = $request->get('strategy_type');
        $projectss->cmu_mis_code = $request->get('cmu_mis_code');
        $projectss->fund_type = $request->get('fund_type');
        $projectss->fund_source = $request->get('fund_source');
        $projectss->started_at = $request->get('started_at');
        $projectss->ended_at = $request->get('ended_at');
        $projectss->fund_giver_name = $request->get('fund_giver_name');
        $projectss->fund_giver_address = $request->get('fund_giver_address');
        $projectss->receipt_list = $request->get('receipt_list');
        $projectss->percent_OHC = $request->get('percent_OHC');
        $projectss->all_money_project = $request->get('all_money_project');
        $projectss->all_OHC = $request->get('all_OHC');
        //'period_calculation' => $request->get('period_calculation'),
        $projectss->project_status = $request->get('project_status');
        $projectss->head_project = $request->get('head_project');
        $projectss->department_subject = $request->get('department_subject');
        //'researcher' => $request->get('researcher'),
        $projectss->OHC_type = $request->get('OHC_type');
        $projectss->cmu = $request->get('cmu');
        $projectss->faculty = $request->get('faculty');
        $projectss->department = $request->get('department');
        $projectss->reason = $request->get('reason');
        // 'present_fund' => $request->get('present_fund'),
        // 'accept_fund' => $request->get('accept_fund'),
        // 'time_no' => $request->get('time_no'),
        // 'end_time' => $request->get('end_time'),

        $projectss->close_project = $request->get('close_project');
        $projectss->result_project = $request->get('result_project');
        $projectss->result_detail = $request->get('result_detail');

        $projectss->save();


        // return view('project.update',compact(
        //     'Projects',




        // ));

      return redirect()->action('ProjectController@show',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projectss = Project::find($id);
        $projectss->delete();

        $projectAuthorizes = ProjectAuthorize::find($id);
        //$authorizes = Authorize::find($id);

        $projectAuthorizes->authorize_lists()->sync([]);
        $projectAuthorizes->authorizes()->delete();
        if ($projectAuthorizes->attachment()->exists()) {
            Storage::delete($projectAuthorizes->attachment->path);
            $projectAuthorizes->attachment()->delete();
        }

        $projectAuthorizes->delete();

        return redirect()->back()->with('success', 'Delete success');
    }
}
