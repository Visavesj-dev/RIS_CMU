@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('visitor.index') }}">อาคันตุกะ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('visitor.show', $visitor) }}">{{ $visitor->university }}</a></li>  
        <li class="breadcrumb-item active" aria-current="page">แก้ไขอาคันตุกะ</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไขอาคันตุกะ</h1>

    <!-- Start Form -->
    <form action="{{ route('visitor.update', $visitor) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">

        @csrf
        @method('PUT')

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
                    <input class="form-control" name="university" id="university" placeholder="ชื่อมหาวิทยาลัย" value="{{ $visitor->university }}" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label for="country">ประเทศ</label>
                <input class="form-control" name="country" id="country" placeholder="ประเทศ" value="{{ $visitor->country->name }}" list="countries" required>
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
                    <input type="date" class="form-control" id="started_at" name="started_at" value="{{ $visitor->started_at->format('Y-m-d') }}" required>
                </div>
                <div class="col">
                    <label for="ended_at">วันสิ้นสุด</label>
                    <input type="date" class="form-control" id="ended_at" name="ended_at" value="{{ $visitor->ended_at->format('Y-m-d') }}" required>
                </div>
                <div class="col">
                    <label for="visited_at">วันเข้าพบ</label>
                    <input type="date" class="form-control" id="visited_at" name="visited_at" value="{{ $visitor->visited_at->format('Y-m-d') }}" required>
                </div>
            </div>
        </div>
        <!-- End of Detail -->

        <!-- Description -->
        <div class="form-group">
            <label for="description">รายละเอียด</label>
            <textarea rows="5" class="form-control" id="description" name="description" required>{{ $visitor->description }}</textarea>
        </div>
        <!-- End of Description -->

        <!-- Note -->
        <div class="form-group">
            <label for="note">หมายเหตุ</label>
            <textarea class="form-control" id="note" name="note">{{ $visitor->note }}</textarea>
        </div>
        <!-- End of Note -->

        <!-- Attachment -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col-3">
                    <label>แนบรูปถ่ายรวม</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment_group_photo" name="attachment_group_photo">
                        <label class="custom-file-label" for="attachment_group_photo">เลือกไฟล์</label>
                    </div>
                    @if ($visitor->attachment_group_photo())
                    <div class="row mt-1">
                        <div class="col text-truncate">
                            <a href="{{ route('file.show', $visitor->attachment_group_photo()) }}">{{ $visitor->attachment_group_photo()->name }}</a>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $visitor->attachment_group_photo()) }}')">ลบไฟล์</button>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="col-3">
                    <label>แนบรูปของที่ระลึก</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment_memento" name="attachment_memento">
                        <label class="custom-file-label" for="attachment_memento">เลือกไฟล์</label>
                    </div>
                    @if ($visitor->attachment_memento())
                    <div class="row mt-1">
                        <div class="col text-truncate">
                            <a href="{{ route('file.show', $visitor->attachment_memento()) }}">{{ $visitor->attachment_memento()->name }}</a>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $visitor->attachment_memento()) }}')">ลบไฟล์</button>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-3">
                    <label>แนบไฟล์สรุปการประชุม</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment_meeting_summary" name="attachment_meeting_summary">
                        <label class="custom-file-label" for="attachment_meeting">เลือกไฟล์</label>
                    </div>
                    @if ($visitor->attachment_meeting_summary())
                    <div class="row mt-1">
                        <div class="col text-truncate">
                            <a href="{{ route('file.show', $visitor->attachment_meeting_summary()) }}">{{ $visitor->attachment_meeting_summary()->name }}</a>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $visitor->attachment_meeting_summary()) }}')">ลบไฟล์</button>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-3">
                    <label>แนบไฟล์อื่นๆ</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment_other" name="attachment_other">
                        <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
                    </div>
                    @if ($visitor->attachment_other())
                    <div class="row mt-1">
                        <div class="col text-truncate">
                            <a href="{{ route('file.show', $visitor->attachment_other()) }}">{{ $visitor->attachment_other()->name }}</a>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $visitor->attachment_other()) }}')">ลบไฟล์</button>
                        </div>
                    </div>
                    @endif
                </div>
        </div>
        <!-- End of Attachment -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('visitor.index') }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
    
    <script>
        function removeFile(action) {
            if (confirm("ต้องการลบไฟล์นี้ใช่หรือไม่")) {
                $('#removeAttachment').attr('action', action).submit();
            }
        }
    </script>
    <form action="" method="POST" id="removeAttachment">
        <input name="_method" type="hidden" value="DELETE">
        @csrf
    </form>
</div>

@endsection
