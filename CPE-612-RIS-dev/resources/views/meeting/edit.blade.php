@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('meeting.index') }}">การประชุมวิชาการ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('meeting.show', $meeting) }}">{{ $meeting->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไข</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <h1 class="pt-4">แก้ไขประชุมวิชาการ</h1>

    <!-- Start Form -->
    <form action="{{ route('meeting.update', $meeting) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input autocomplete="false" type="text" style="display:none;">
        @method('PUT')
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

        <!-- Type -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>หัวข้อการประชุม</label>
                    <input type="text" class="form-control" name="title" value="{{ $meeting->title }}" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>วันที่เริ่มต้นการประชุม</label>
                    <input type="date" class="form-control" name="started_at" value="{{ $meeting->started_at->format('Y-m-d') }}" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>วันที่สิ้นสุดการประชุม</label>
                    <input type="date" class="form-control" name="ended_at" value="{{ $meeting->ended_at->format('Y-m-d') }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>หัวหน้าโครงการ</label>
                    <input type="text" class="form-control" list="lecturers" name="head_of_project" value="{{ $meeting->head_of_project }}" required>
                    <datalist id="lecturers">
                        @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->fullname }}">{{ $lecturer->fullname }}</option>
                        @endforeach    
                    </datalist>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ภาควิชาที่สังกัด</label>
                    <select class="custom-select" name="department_id" required>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $meeting->department_id == $department->id ? 'selected':'' }}>{{ $department->name }}</option>
                        @endforeach                    
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>งบประมาณโครงการ</label>
                    <input type="number" class="form-control" name="budget" value="{{ $meeting->budget }}" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>สถานที่จัดงานประชุม</label>
                    <input type="text" class="form-control" name="meeting_place" value="{{ $meeting->meeting_place }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>การขอมอบอำนาจ</label>
                <div class="form-check">
                    <input type="hidden" name="authorize_financial" value="0">
                    <input class="form-check-input" type="checkbox" name="authorize_financial" value="1" id="authorize_financial" {{ $meeting->authorize_financial ? 'checked':'' }}>
                    <label class="form-check-label" for="authorize_financial">
                        เจ้าหน้าที่การเงินและออกใบเสร็จ
                    </label>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label>การขอมอบอำนาจอื่น ๆ</label>
                    <input type="text" class="form-control" name="authorize_other" value="{{ $meeting->authorize_other }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>พรบ.60 จัดซื้อจัดจ้าง</label>
                    <input type="text" class="form-control" name="procurement_act" value="{{ $meeting->procurement_act }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('meeting.show', $meeting) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>



@endsection