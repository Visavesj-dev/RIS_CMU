@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('project.show',request('project_id')) }}">โครงการ #{{ request('project_name') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('project-installment.index') }}?project_id={{request('project_id')}}&project_name={{request('project_name')}}">งวดโครงการ</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขงวดโครงการ </li>
    </ol>
<meta name="viewport" content="width=device-width, initial-scale=1">
</nav>
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



<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <h1 class="pt-4">เพิ่มงวดโครงการ  #{{ request('project_name') }}</h1>


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
    <form action="{{ route('project-installment.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input autocomplete="false" type="text" style="display:none;">

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

        <hr>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>งวดที่</label>
                            <input type="text" name="no" value = "{{ old('no')}}" class="form-control" required>
                        </div>
                    </div>

                    <input type="hidden" name="project_id" id="project_id" value = "{{request('project_id')}}"required>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>วันที่สัญญา</label>
                            <input type="date" name="promised_date" value = "{{ old('promised_date')}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>วันที่รับจริง</label>
                            <input type="date" name="receive_date" value = "{{ old('receive_date')}}" class="form-control">
                        </div>
                    </div>





                    <div class="col-md-3">
                        <div class="form-group">
                            <label>เงินงวด</label>
                            <input type="text" name="fund" id ='fund' value = "{{ old('fund')}}" class="form-control" required>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ธรรมเนียม</label>
                            <input type="text" name="fee" id='fee' value = "{{ old('fee')}}" class="form-control">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>เงินล่วงหน้า</label>
                            <input type="text" name="advance" id ='advance' value = "{{ old('advance')}}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ประกันผลงาน</label>
                            <input type="text" name="insurance" id='insurance' value = "{{ old('insurance')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>มช.</label>
                            <input type="text" name="university" id='university' value = "{{ old('university')}}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>คณะ</label>
                            <input type="text" name="faculty" id='faculty' value = "{{ old('faculty')}}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ภาควิชา</label>
                            <input type="text" name="department" id='department' value = "{{ old('department')}}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>นักวิจัย</label>
                            <input style="background-color: #EBEBEB" type="string" name="researcher" id='researcher' value = "{{ old('researcher')}}" class="form-control"required>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>OHC</label>
                            <input style="background-color: #EBEBEB" type="text" name="ohc" id='ohc' value = "{{ old('ohc')}}" class="form-control"required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>อื่นๆ</label>
                            <input type="text" name="others" class="form-control" value="{{ old('others')}}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>หมายเหตุ</label>
                            <input type="text" name="notes" class="form-control" value="{{ old('notes')}}" >
                        </div>
                </div>

                </div>

                <script>

                    default_value1();  //call function default value from project_installment.js
            
                </script>
                <div class="d-flex flex-row-reverse">
                    <button type="button" onclick="default_value1()" style="margin: 30px ; background-color: #FBC02D" class="btn rounded">คำนวณ OHC</button>
                </div>

                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('project-installment.index') }}?project_id={{request('project_id')}}&project_name={{request('project_name')}}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>

            </div>

        </div>

    </form>
</div>
@endsection

@section('script')
<script src="{{ asset('js/research.js') }}" defer></script>
<script src="{{ asset('js/project_installment.js') }}" defer></script>
@endsection
