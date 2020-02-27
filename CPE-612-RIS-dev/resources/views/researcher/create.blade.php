@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('project.show',request('project_id')) }}">โครงการ #{{ request('project_name') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('researcher.index') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}">ผู้ร่วมวิจัย</a></li>
        <li class="breadcrumb-item active" aria-current="page">สร้าง</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">เพิ่มผู้ร่วมวิจัย</h1>

    <!-- Start Form -->
    <form action="{{ route('researcher.store') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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


        <!-- Lecturer -->
        <div class="row">
            <input type="hidden" name="project_id" id="project_id" value = "{{request('project_id')}}"required>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ผู้รับผิดชอบ</label>
                    <select class="custom-select" name="lecturer" id="lecturer-selector"  onchange="myFunction()" required>
                        <option value="">ไม่เลือก</option>
                        @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ Request::input('lecturer') == $lecturer->id ? 'selected':'' }}>{{ $lecturer->fullname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>สังกัด</label>
                    <select class="custom-select" name="department_id" id="department_id" required>
                        <option value="">ไม่เลือก</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
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
                    <input type="text" name="work_ratio" class="form-control" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>สัดส่วน OHC</label>
                    <input type="text" name="OHC" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>หมายเหตุ</label>
                    <textarea type="text" name="note" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('researcher.index') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">สร้าง</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection

@section('script')
<script src="{{ asset('js/researcher.js') }}" defer></script>
@endsection
