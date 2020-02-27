@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('visitor.index') }}">อาคันตุกะ</a></li>
        <li class="breadcrumb-item active" aria-current="page">เพิ่ม</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">เพิ่มอาคันตุกะ</h1>

    <!-- Start Form -->
    <form action="{{ route('visitor.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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

        <!-- University -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="university">มหาวิทยาลัย</label>
                    <input class="form-control" name="university" id="university" placeholder="ชื่อมหาวิทยาลัย" value="{{ old('university') }}" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label for="country">ประเทศ</label>
                <input class="form-control" name="country" id="country" placeholder="ประเทศ" value="{{ old('country') }}" list="countries" required>
                <datalist id="countries">
                        @foreach ($countries as $country)
                        <option value="{{ $country->name }}"></option>
                        @endforeach
                </datalist>
                </div>                
            </div>
        </div>
        <!-- End of University -->

        <!-- Detail -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col">
                    <label for="started_at">วันเริ่มต้น</label>
                    <input type="date" class="form-control" id="started_at" name="started_at" value="{{ old('started_at') }}" required>
                </div>
                <div class="col">
                    <label for="ended_at">วันสิ้นสุด</label>
                    <input type="date" class="form-control" id="ended_at" name="ended_at" value="{{ old('ended_at') }}" required>
                </div>
                <div class="col">
                    <label for="visited_at">วันเข้าพบ</label>
                    <input type="date" class="form-control" id="visited_at" name="visited_at" value="{{ old('visited_at') }}" required>
                </div>
            </div>
        </div>
        <!-- End of Detail -->

        <!-- Description -->
        <div class="form-group">
            <label for="description">รายละเอียด</label>
            <textarea rows="5" class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
        </div>
        <!-- End of Description -->

        <!-- Note -->
        <div class="form-group">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" id="note" name="note">{{ old('note') }}</textarea>
        </div>
        <!-- End of Note -->

        <!-- Attachment -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col">
                    <label>แนบรูปถ่ายรวม</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment_group_photo" name="attachment_group_photo">
                        <label class="custom-file-label" for="attachment_group_photo">เลือกไฟล์</label>
                    </div>
                </div>
                <div class="col">
                    <label>แนบรูปของที่ระลึก</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment_memento" name="attachment_memento">
                        <label class="custom-file-label" for="attachment_memento">เลือกไฟล์</label>
                    </div>
                </div>
                <div class="col">
                    <label>แนบไฟล์สรุปการประชุม</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment_meeting_summary" name="attachment_meeting_summary">
                        <label class="custom-file-label" for="attachment_meeting">เลือกไฟล์</label>
                    </div>
                </div>
                <div class="col">
                    <label>แนบไฟล์อื่นๆ</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment_other" name="attachment_other">
                        <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
                    </div>
                </div>
        </div>
        <!-- End of Attachment -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('visitor.index') }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">สร้าง</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection
