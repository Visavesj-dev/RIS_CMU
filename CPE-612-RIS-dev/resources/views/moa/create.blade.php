@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('moa.index') }}">MoA</a></li>
        <li class="breadcrumb-item active" aria-current="page">สร้าง</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">สร้าง MoA</h1>

    <!-- Start Form -->
    <form action="{{ route('moa.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">

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

        <!-- Title -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ชื่อ</label>
                    <input type="text" class="form-control" name="title">
                </div>
            </div>
            @if (Request::filled('mou_id'))
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ภายใต้ MoU</label>
                    <input type="hidden" name="mou_id" value="{{ Request::input('mou_id') }}">
                    <a href="{{ route('mou.show', Request::input('mou_id')) }}" target="blank"
                        class="form-control">#{{ Request::input('mou_id') }}</a>
                </div>
            </div>
            @endif
        </div>
        <!-- End of Title -->

        <!-- Departments -->
        <div class="form-group">
            <label for="type">ภาควิชาที่เกี่ยวข้อง</label>
            <div class="container">
                @foreach ($departments as $department)
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="departments[]"
                        id="department-{{ $loop->index }}" value="{{ $department->id }}"
                        {{ collect(old('departments'))->contains($department->id) ? 'checked':''  }}>
                    <label class="form-check-label" for="department-{{ $loop->index }}">{{ $department->name }}</label>
                </div>
                @endforeach
            </div>

            <div class="input-group mb-3 ml-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        อื่น ๆ
                    </div>
                </div>
                <input type="text" class="form-control" name="department_custom" list="departments"
                    value="{{ old('department_custom') }}">
            </div>

            <datalist id="departments">
                @foreach ($suggestedDepartments as $department)
                <option value="{{ $department->name }}"></option>
                @endforeach
            </datalist>
        </div>
        <!-- End of Departments -->

        <!-- Detail -->
        <div class="form-group">
            <label for="detail">รายละเอียดข้อตกลง</label>
            <textarea class="form-control" id="detail" name="detail" required>{{ old('detail' )}}</textarea>
        </div>
        <!-- End of Detail -->

        <!-- Detail -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col">
                    <label for="made_agreement_at">วันลงนามข้อตกลง</label>
                    <input type="date" class="form-control" id="made_agreement_at" name="made_agreement_at"
                        value="{{ old('made_agreement_at') }}" required>
                </div>
                <div class="col">
                    <label for="started_at">วันเริ่มข้อตกลง</label>
                    <input type="date" class="form-control" id="started_at" name="started_at"
                        value="{{ old('started_at') }}" required>
                </div>
                <div class="col">
                    <label for="ended_at">วันสิ้นสุดข้อตกลง</label>
                    <input type="date" class="form-control" id="ended_at" name="ended_at" value="{{ old('ended_at') }}"
                        required>
                </div>
            </div>
        </div>
        <!-- End of Detail -->


        <!-- Attachment -->
        <div class="form-group">
            <label>ไฟล์แนบ</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="attachment" name="attachment">
                <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
            </div>
        </div>
        <!-- End of Attachment -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('moa.index') }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">สร้าง</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection