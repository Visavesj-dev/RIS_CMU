
    @extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('project.show', $projectss) }}">โครงการ #{{$projectss -> project_name }}</a></li>
        <li class="breadcrumb-item">แก้ไขโครงการ</li>
    </ol>
</nav>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border-bottom: 1px solid #ccc;
            background-color: white;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
</head>

<body>

        <div class="tab">
            <button class="tablinks" type="button">ข้อมูลทั่วไป</button>
        </div>


    <!-- Adding Container -->
    <div class="container-fluid bg-white rounded pb-2 mb-4">

        @if(count($errors) > 0)
        <!-- กรณีผิดพลาด -->
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        <br>
        @endif
        
        @if(\Session::has('success'))
        <!-- กรณีสำเร็จ -->
        <div class="alert alert-success">
            <h5>{{ \Session::get('success') }}</h5>
        </div>
        <br>
        @endif
        
        <!-- Start Form -->
        <form action="{{ route('project.update',$projectss)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            <input name="_method" type="hidden" value="PUT">

            @csrf

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <br>

            <!-- Tab panes -->
            <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ประเภทโครงการ</label>
                                    <input type="text" class="form-control" name="project_type"
                                        value="{{ $projectss->project_type}}" list="project_type" required>
                                    <datalist id="project_type">
                                        @foreach ($ProjectTypes as $type)
                                        <option value="{{ $type->name }}"
                                            {{ $projectss->project_type == $type->name ? 'selected':'' }}>
                                        </option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ชื่อโครงการ/กิจกรรม</label>
                                    <input class="form-control" name="project_name" value="{{ $projectss->project_name}}"
                                        required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ประเภทยุทธศาสตร์</label>
                                    <input type="text" class="form-control" name="strategy_type"
                                        value="{{ $projectss->strategy_type}}" list="strategy_type" required>
                                    <datalist id="strategy_type">
                                        @foreach ($StrategyTypes as $type)
                                        <option value="{{ $type->name }}"
                                            {{ $projectss->strategy_type == $type->name ? 'selected':'' }}>
                                        </option>
                                        @endforeach
                                    </datalist>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>รหัส CMU SIS</label>
                                    <input type="text" class="form-control" name="cmu_mis_code"
                                        value="{{ $projectss->cmu_mis_code}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ประเภททุน</label>
                                    <input type="text" class="form-control" name="fund_type" value="{{ $projectss->fund_type}}"
                                        list="fund_type" required>
                                    <datalist id="fund_type">
                                        @foreach ($FundTypes as $type)
                                        <option value="{{ $type->name }}"
                                            {{ $projectss->fund_type == $type->name ? 'selected':'' }}>
                                        </option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ชื่อแหล่งทุน</label>
                                    <input type="text" class="form-control" name="fund_source"
                                        value="{{ $projectss->fund_source}}" required>
                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>วันที่เริ่มต้นโครงการ</label>
                                    <input type="date" class="form-control" name="started_at" value="{{ $projectss->started_at}}"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>วันสิ้นสุดโครงการ</label>
                                    <input type="date" class="form-control" name="ended_at" value="{{ $projectss->ended_at}}"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ชื่อหน่วยงานออกใบเสร็จ</label>
                                    <input type="text" class="form-control" name="fund_giver_name"
                                        value="{{ $projectss->fund_giver_name}}" list="fund_giver_name" required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ที่อยู่หน่วยงานออกใบเสร็จ</label>
                                    <input type="text" class="form-control" name="fund_giver_address"
                                        value="{{ $projectss->fund_giver_address}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>รายการใบเสร็จ</label>
                                    <input type="text" class="form-control" name="receipt_list"
                                        value="{{ $projectss->receipt_list}}" required>
                                </div>
                            </div>

                            <script>
                                calculate();    //call from projectJava.js
                            </script>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>จำนวณงวด</label>
                                    <input style="background-color: #cccccc" type="text" class="form-control"
                                        name="period_calculation" list="period_calculation" disabled>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>งบประมาณทั้งโครงการ</label>
                                    <input id="all_money_project" type="text" class="form-control" name="all_money_project"
                                        value="{{ $projectss->all_money_project}}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ค่า OHC ทั้งหมด</label>
                                    <input id="all_OHC" onblur="calculate()" type="text" class="form-control" name="all_OHC"
                                        value="{{ $projectss->all_OHC}}" required>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ร้อยละ OHC</label>
                                    <input id="percent_OHC" type="text" class="form-control" name="percent_OHC"
                                        value="{{ $projectss->percent_OHC}}" required>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>สถานะโครงการ</label>
                                    <input type="text" class="form-control" name="project_status"
                                        value="{{ $projectss->project_status}}" list="project_status" required>
                                    <datalist id="project_status">
                                        @foreach ($ProjectStatus as $type)
                                        <option value="{{ $type->name }}"
                                            {{ $projectss->project_status == $type->name ? 'selected':'' }}>
                                        </option>
                                        @endforeach

                                    </datalist>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>หัวหน้าโครงการ</label>
                                    <input type="text" class="form-control" name="head_project" id="head"
                                        onchange="myFunction()" value="{{ $projectss->head_project}}" list="head_project"
                                        required>
                                    <datalist id="head_project">
                                        @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->fullname }}"
                                            {{ $projectss->head_project == $lecturer->fullname ? 'selected':'' }}></option>
                                        @endforeach

                                    </datalist>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ภาควิชาที่สังกัด</label>
                                    <input type="text" class="form-control" name="department_subject" id="department"
                                        value="{{ $projectss->department_subject}}" list="department_subject" required>
                                    <datalist id="department_subject">
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->name }}"
                                            {{ $projectss->department_subject == $department->id ? 'selected':'' }}>
                                            {{ $department->name }}
                                        </option>
                                        @endforeach


                                    </datalist>


                                </div>
                            </div>

                        </div>

                        {{-- script ของ หัวหน้าโครงการ กับ department --}}

                        <script>
                                function myFunction() {
                                    var lecturer = {!! json_encode($lecturers->toArray()) !!};
                                    for (var i = 0; i < lecturer.length; i++) {
                                        if (lecturer[i].fullname == document.getElementById("head").value) {
                                            document.getElementById("department").value = lecturer[i].major;
                                        }
                                    }
                                    //console.log(lecturer);
                                }
                                </script>

                        {{-- /////////////////////////////////////////// --}}

                        <!-- แก้เพิ่มเติมเริ่มตรงนี้ -->
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>จำนวณผู้วิจัย</label>
                                    <input style="background-color: #cccccc" type="text" class="form-control"
                                        name="researcher" list="researcher" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ประเภทการเเบ่ง OHC</label>
                                    <input type="text" class="form-control" id="OHC_types" name="OHC_type"
                                        value="{{ $projectss->OHC_type}}" list="OHC_type" required>
                                    <datalist id="OHC_type">
                                        @foreach ($OHCtypes as $type)
                                        <option value="{{ $type->name }}"
                                            {{ $projectss->OHC_type == $type->name ? 'selected':'' }}>
                                        </option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <div>
                                <div class="d-flex flex-row-reverse">
                                    <button type="button" style="margin: 30px ; background-color: #FBC02D"
                                        onclick="separate_OHC()" class="btn rounded ">คำนวณ OHC</button>
                                </div>
                            </div>

                        </div>

                        <script>
                            separate_OHC();
                        </script>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>มช</label>
                                    <input id="cmu" type="text" class="form-control" name="cmu" value="{{$projectss->cmu}}"
                                        list="cmu" required>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>คณะวิศวกรรมศาสตร์</label>
                                    <input id="faculty" type="text" class="form-control" name="faculty"
                                        value="{{$projectss->faculty}}" list="faculty" required>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ภาควิชา</label>
                                    <input id="departments" type="text" class="form-control" name="department"
                                        value="{{$projectss->department}}" list="department" required>

                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>เหตุผล</label>
                                    <input type="text" class="form-control" name="reason" value="{{ $projectss->reason}}"
                                        list="reason">

                                </div>
                            </div>

                        </div>

                        <hr>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>งวดเงินปัจจุบัน</label>
                                    <input style="background-color: #cccccc" type="text" class="form-control"
                                        name="present_fund" list="present_fund" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>วันที่ได้รับเงินงวด</label>
                                    <input style="background-color: #cccccc" type="text" class="form-control"
                                        name="accept_fund" list="accept_fund" disabled>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ขยายเวลาครั้งที่</label>
                                    <input style="background-color: #cccccc" type="text" class="form-control" name="time_no"
                                        list="time_no" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>วันที่สิ้นสุดการขยายเวลา</label>
                                    <input style="background-color: #cccccc" type="text" class="form-control" name="end_time"
                                        list="end_time" disabled>
                                </div>
                            </div>

                        </div>


                        <div class="row">



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>วันที่ปิดโครงการ</label>
                                    <input type="date" class="form-control" name="open_project" list="open_project">
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-md-10">
                                <div class="form-group">

                                    {{-- <input type="text" id="result_project" class="form-control" name="result_project"
                                        value="{{ old('result_project')}}" list="result_project" required>
                                    <datalist id="result_projects">
                                        <option value=" ">
                                    </datalist> --}}

                                    <form id="add_name">
                                        <div class="table-responsive">
                                            <table id="dynamic_field">
                                                <tr>
                                                    <td>
                                                        <label>ผลลัพธ์โครงการ</label>
                                                        <input type="text" id="result_project" name="result_project"
                                                            value="{{ $projectss->result_project}}" style="width: 350px "
                                                            class="form-control name_list" name="result_project">


                                                    </td>

                                                    <td>
                                                        <label style="margin-left: 25px">รายละเอียดผลลัพธ์</label>
                                                        <input type="text" id="result_detail" name="result_detail"
                                                            value="{{ $projectss->result_detail}}"
                                                            style="width: 350px ; margin-left: 25px"
                                                            class="form-control name_list">


                                                    </td>


                                                    {{-- <td><button style="margin-top: 30px" type="button" name="add" id="add"
                                                            class="btn btn-success" disabled>+
                                                            เพิ่มผลลัพธ์</button>
                                                    </td> --}}

                                                </tr>
                                            </table>

                                        </div>
                                    </form>

                                </div>

                                {{-- <div class="col-md-5.5">
                                <div class="form-group">
                                    <label>รายละเอียดผลลัพธ์</label>
                                    <input type="text" id="result_detail" class="form-control" name="result_detail"
                                        value="{{ old('result_detail')}}" list="result_detail" required>
                                <datalist id="fund_type">
                                    <option value=" ">
                                </datalist>
                            </div>


                            <form id="add_name">
                                <div class="table-responsive">
                                    <table id="dynamic_field1">
                                        <tr>
                                            <td>
                                                <input type="text" id="result_detail" name="result_detail"
                                                    value="{{ old('result_detail')}}" style="width: 350px"
                                                    class="form-control name_list" required>


                                            </td>

                                            <td><button type="button" name="add" id="add" class="btn btn-success">+
                                                    เพิ่มผลลัพธ์</button></td>
                                        </tr>
                                    </table>

                                </div>
                            </form>

                        </div> --}}

                    </div>

                    {{-- <div>
                        <div class="d-flex flex-row-reverse">
                            <button type="button" style="margin: 30px " class="btn btn-success rounded"
                                onclick="myFunction()">+ เพิ่มผลลัพธ์</button>
                        </div>
                    </div>  --}}


                </div>

                <br><br>


                <!-- สิ้นสุดแก้ไข้ -->

                <div class="row">
                    <div class="mb-6 col-md-6 offset-md-6">
                        <div class="d-flex flex-row-reverse">
                            <a href="{{ route('project.show', $projectss) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary mt-3 mb-4">สร้าง</button>
                        </div>
                    </div>
                </div>

                <datalist id="project_type">
                    <!-- # -->
                </datalist>

                <datalist id="strategy_type">
                    <!-- # -->
                </datalist>

                <datalist id="fund_type">
                    <!-- # -->
                </datalist>

                <datalist id="status">
                    <!-- # -->
                </datalist>

                <datalist id="project_result">
                    <!-- # -->
                </datalist>
             </div>

            </div>


         </form>
    </div>
    @endsection

    @section('script')
    <script src="{{ asset('js/research.js') }}" defer></script>
    <script src="{{ asset('js/projectJava.js') }}" defer></script>
    @endsection
