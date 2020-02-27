@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('moa.index') }}">MoA</a></li>
        <li class="breadcrumb-item"><a href="{{ route('moa.show', $moa) }}">#{{ $moa->id}}</a></li>        
        <li class="breadcrumb-item active" aria-current="page">แก้ไข</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไข MoA #{{ $moa->id }}</h1>

    <!-- Start Form -->
    <form action="{{ route('moa.update', $moa) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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

        <!-- Title -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ชื่อ</label>
                    <input type="text" class="form-control" name="title" value="{{ $moa->title }}" required>
                </div>
            </div>
            @if ($moa->mou()->exists())
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ภายใต้ MoU</label>
                    <a href="{{ route('mou.show', $moa->mou) }}" class="form-control">#{{ $moa->mou->id }}</a>
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
                    <input type="checkbox" class="form-check-input" name="departments[]" id="department-{{ $loop->index }}"
                        value="{{ $department->id }}"
                        {{ $moa->departments->contains($department) ? 'checked':''  }}>
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
                <input type="text" class="form-control" name="department_custom" list="departments" value="{{ optional($moa->otherDepartment)->name }}">
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
            <textarea class="form-control" id="detail" name="detail" required>{{ $moa->detail }}</textarea>
        </div>
        <!-- End of Detail -->

        <!-- Detail -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col">
                    <label for="made_agreement_at">วันลงนามข้อตกลง</label>
                    <input type="date" class="form-control" id="made_agreement_at" name="made_agreement_at" value="{{ $moa->made_agreement_at->format('Y-m-d') }}" required>
                </div>
                <div class="col">
                    <label for="started_at">วันเริ่มข้อตกลง</label>
                    <input type="date" class="form-control" id="started_at" name="started_at" value="{{ $moa->started_at->format('Y-m-d') }}" required>
                </div>
                <div class="col">
                    <label for="ended_at">วันสิ้นสุดข้อตกลง</label>
                    <input type="date" class="form-control" id="ended_at" name="ended_at" value="{{ $moa->ended_at->format('Y-m-d') }}" required>
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
            @if ($moa->attachment()->exists())
            <div class="mt-1">
                <a href="{{ route('file.show', $moa->attachment) }}">{{ $moa->attachment->name }}</a>

                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile()">ลบไฟล์</button>
            </div>
            @endif
        </div>
        <!-- End of Attachment -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                        <a href="{{ route('moa.show', $moa) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>

    @if ($moa->attachment()->exists())
    <script>
        function removeFile() {
            if (confirm("ต้องการลบไฟล์นี้ใช่หรอไม่")) {
                $('#removeAttachment').submit();
            }
        }
    </script>
    <form action="{{ route('file.destroy', $moa->attachment) }}" method="POST" id="removeAttachment">
        <input name="_method" type="hidden" value="DELETE">
        @csrf
    </form>
    @endif
</div>

@endsection
