@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('activity.index') }}">กิจกรรม</a></li>  
        <li class="breadcrumb-item"><a href="{{ route('activity.show', $activity) }}">#{{ $activity->id}}</a></li>  
        <li class="breadcrumb-item active" aria-current="page">แก้ไข</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไขกิจกรรม #{{ $activity->id }}</h1>

    <!-- Start Form -->
    <form action="{{ route('activity.update', $activity) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
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

        <!-- Title -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ชื่อ</label>
                    <input type="text" class="form-control" name="title" value="{{ $activity->title }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ภายใต้</label>
                    <input type="hidden" name="parent" value="{{ $activity->parent instanceof App\Mou ? 'mou':'moa' }}">

                    @if ($activity->parent instanceof App\Mou)
                    <input type="hidden" name="mou_id" value="{{ $activity->parent->id }}">
                    <a href="{{ route('mou.show', $activity->parent) }}" target="blank" class="form-control">
                        MoU#{{ $activity->parent->id }}</a>
                    @else
                    <input type="hidden" name="moa_id" value="{{ $activity->parent->id }}">
                    <a href="{{ route('moa.show', $activity->parent) }}" target="blank" class="form-control">
                        MoA#{{ $activity->parent->id }} {{ $activity->parent->title }}</a>
                    @endif
                </div>
            </div>
        </div>
        <!-- End of Title -->

        <!-- Lecturer -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ผู้รับผิดชอบ</label>
                    <select class="custom-select" name="lecturer_id" id="lecturer-selector" required>
                        <option value="">ไม่เลือก</option>
                        @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}" {{ $activity->lecturer->id == $lecturer->id ? 'selected':'' }}>{{ $lecturer->fullname }} ({{ $lecturer->major }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- End of Lecturer -->

        <!-- Programs -->
        <div class="form-group">
            <label for="type">กิจกรรม</label>
            <div class="container">
                @foreach ($programs as $program)
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="programs[]" id="program-{{ $loop->index }}"
                        value="{{ $program->id }}"
                        {{ $activity->programs->contains($program) ? 'checked':''  }}>
                    <label class="form-check-label" for="program-{{ $loop->index }}">{{ $program->name }}</label>
                </div>
                @endforeach
            </div>

            <div class="input-group mb-3 ml-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        อื่น ๆ
                    </div>
                </div>
                <input type="text" class="form-control" name="program_custom" list="programs" value="{{ optional($activity->programe_custom)->name }}">
            </div>

            <datalist id="programs">
                @foreach ($suggestedPrograms as $program)
                <option value="{{ $program->name }}"></option>
                @endforeach
            </datalist>
        </div>
        <!-- End of Programs -->

        <!-- Detail -->
        <div class="form-group">
            <label for="detail">รายละเอียด</label>
            <textarea class="form-control" id="detail" name="detail" required>{{ $activity->detail }}</textarea>
        </div>
        <!-- End of Detail -->

        <!-- Detail -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col-md-4">
                    <label for="started_at">วันเริ่มกิจกรรม</label>
                    <input type="date" class="form-control" id="started_at" name="started_at" value="{{ $activity->started_at->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="ended_at">วันสิ้นสุดกิจกรรม</label>
                    <input type="date" class="form-control" id="ended_at" name="ended_at" value="{{ $activity->ended_at->format('Y-m-d') }}" required>
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
            @if ($activity->attachment()->exists())
            <div class="mt-1">
                <a href="{{ route('file.show', $activity->attachment) }}">{{ $activity->attachment->name }}</a>

                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile()">ลบไฟล์</button>
            </div>
            @endif
        </div>
        <!-- End of Attachment -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('activity.show', $activity) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>

    @if ($activity->attachment()->exists())
    <script>
        function removeFile() {
            if (confirm("ต้องการลบไฟล์นี้ใช่หรอไม่")) {
                $('#removeAttachment').submit();
            }
        }
    </script>
    <form action="{{ route('file.destroy', $activity->attachment) }}" method="POST" id="removeAttachment">
        <input name="_method" type="hidden" value="DELETE">
        @csrf
    </form>
    @endif

</div>

@endsection

@section('script')
<script src="{{ asset('js/activity.create.js') }}" defer></script>
@endsection