@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">โครงการ</li>
        <li class="breadcrumb-item active" aria-current="page">#{{ request('project_id') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('researcher.index') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}">ผู้ร่วมวิจัย</a></li>
        <li class="breadcrumb-item active" aria-current="page">#{{ $researcher->id }}</li>
        <li class="breadcrumb-item">แก้ไขผู้ร่วมวิจัย</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <h1 class="pt-4">แก้ไขผู้ร่วมวิจัย #{{$researcher->id}}</h1>
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
    <form action="{{ route('researcher.update', $researcher) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
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

        <hr>

        <!-- Tab panes -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ผู้รับผิดชอบ</label>
                    <select class="custom-select" name="lecturer" id="lecturer-selector" onchange="myFunction()"
                        required>
                        @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ $researcher->reseacher_id == $lecturer->id ? 'selected':'' }}>{{ $lecturer->fullname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>สังกัด</label>
                    <select class="custom-select" name="department_id" id="department_id" required>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}"{{ $researcher->department_id == $department->id ? 'selected':'' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <script>
            function myFunction() {

                var lecturer = {!!json_encode($lecturers->toArray()) !!};
                var department = {!!json_encode($departments->toArray()) !!};
                

                for (var i = 0; i < lecturer.length; i++) {
                    if (lecturer[i].id == document.getElementById("lecturer-selector").value) {
                        for (var j = 0; j < department.length; j++) {
                            if (department[j].name == lecturer[i].major) {
                                document.getElementById("department_id").value = department[j].id;
                            }
                        }
                    }
                }
                
            }
            </script>

            <div class="col-md-2">
                <div class="form-group">
                    <label>สัดส่วนงาน</label>
                    <input value="{{ $researcher->work_ratio }}" type="text" name="work_ratio" class="form-control" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>สัดส่วน OHC</label>
                    <input value="{{ $researcher->OHC }}" type="text" name="OHC" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>หมายเหตุ</label>
                    <textarea value="{{ $researcher->note }}" type="text" name="note" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('researcher.index') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection

@section('script')
<script src="{{ asset('js/researcher.js') }}" defer></script>
@endsection