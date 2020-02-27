@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('outbound-student.index') }}">นักศึกษาไทย</a></li>        
        <li class="breadcrumb-item"><a href="{{ route('outbound-student.show', $outboundStudent) }}">{{ $outboundStudent->full_name }}</a></li>        
        <li class="breadcrumb-item active" aria-current="page">แก้ไข</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไขนักศึกษาไทย {{ $outboundStudent->full_name }}</h1>

    <!-- Start Form -->
    <form action="{{ route('outbound-student.update', $outboundStudent) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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

        <!-- Info -->
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>ประเภท</label>
                    <select class="form-control" name="student_type_id" required>
                        @foreach ($studentTypes as $type)
                        <option value="{{ $type->id }}" {{ $outboundStudent->student_type_id == $type->id ? 'selected':'' }}>
                            {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>รหัสนักศึกษา</label>
                    <input type="text" class="form-control" name="student_id" value="{{ $outboundStudent->student_id }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>คำนำหน้าชื่อ</label>
                    <input type="text" class="form-control" name="prefix" required value="{{ $outboundStudent->prefix }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ชื่อจริง</label>
                    <input type="text" class="form-control" name="first_name" required value="{{ $outboundStudent->first_name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>นามสกุล</label>
                    <input type="text" class="form-control" name="last_name" required value="{{ $outboundStudent->last_name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ภาควิชา</label>
                    <select class="form-control" name="department_id" required>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $outboundStudent->department_id == $department->id ? 'selected':'' }}>
                            {{ $department->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>อาจารย์ที่ปรึกษา</label>
                    <select class="form-control" name="advisor_id" id="advisor-selector" required>
                        @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ $outboundStudent->advisor_id == $lecturer->id ? 'selected':'' }}>{{ $lecturer->fullname }} ({{ $lecturer->major }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>เบอร์ติดต่อในไทย</label>
                    <input type="text" class="form-control" name="telephone" value="{{ $outboundStudent->telephone }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>อีเมล</label>
                    <input type="email" class="form-control" name="email" required value="{{ $outboundStudent->email }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>เลขที่หนังสือเดินทาง</label>
                    <input type="text" class="form-control" name="passport_id" required value="{{ $outboundStudent->passport_id }}">
                </div>
            </div>
        </div>
        <!-- End of Info -->

        <hr>

        <!-- Cooperation -->
        <h4>โครงการ</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>ชื่อความร่วมมือ</label>
                    <input type="text" class="form-control" name="cooperation_name" value="{{ $outboundStudent->cooperation_name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ชื่อโครงการ</label>
                    <input type="text" class="form-control" name="project" value="{{ $outboundStudent->project }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>วันที่เดินทางไป</label>
                    <input type="date" class="form-control" name="travelled_at" value="{{ $outboundStudent->travelled_at->format('Y-m-d') }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>วันที่เดินทางกลับ</label>
                    <input type="date" class="form-control" name="returned_at" value="{{ $outboundStudent->returned_at->format('Y-m-d') }}">
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label>มหาวิทยาลัยปลายทาง</label>
                    <input type="text" class="form-control" name="university" list="universities"  value="{{ $outboundStudent->university }}">

                    <datalist id="universities">
                        @foreach($universities as $university)
                        <option value="{{ $university->university }}">
                            {{ $university->university }}
                        </option>
                        @endforeach
                    </datalist>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ผู้ประสานงาน</label>
                    <input type="text" class="form-control" name="coordinator_name" value="{{ $outboundStudent->coordinator_name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>อีเมลผู้ประสานงาน</label>
                    <input type="email" class="form-control" name="coordinator_email" value="{{ $outboundStudent->coordinator_email }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>วิชาที่เรียน</label>
                    <input type="text" class="form-control" name="subject" value="{{ $outboundStudent->subject }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ที่พัก</label>
                    <input type="text" class="form-control" name="accommodation" value="{{ $outboundStudent->accommodation }}">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>หมายเหตุ</label>
                    <textarea class="form-control" name="note">
                        {{ $outboundStudent->note }}
                    </textarea>
                </div>
            </div>

            <div class="col-md-4">
                <label>แนบรูปถ่าย</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachment_photo" id="attachment_photo">
                    <label class="custom-file-label" for="attachment_photo">เลือกไฟล์</label>
                </div>
                @if ($outboundStudent->photo())
                <div class="mt-1">
                    <a href="{{ route('file.show', $outboundStudent->photo()) }}">{{ $outboundStudent->photo()->name }}</a>

                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $outboundStudent->photo()) }}')">ลบไฟล์</button>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <label>แนบหนังสือเดินทาง</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachment_passport" id="attachment_passport">
                    <label class="custom-file-label" for="attachment_passport">เลือกไฟล์</label>
                </div>
                @if ($outboundStudent->passport())
                <div class="mt-1">
                    <a href="{{ route('file.show', $outboundStudent->passport()) }}">{{ $outboundStudent->passport()->name }}</a>

                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $outboundStudent->passport()) }}')">ลบไฟล์</button>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <label>แนบรายงานโครงการ</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachment_activity_report" id="attachment_activity_report">
                    <label class="custom-file-label" for="attachment_activity_report">เลือกไฟล์</label>
                </div>
                @if ($outboundStudent->activityReport())
                <div class="mt-1">
                    <a href="{{ route('file.show', $outboundStudent->activityReport()) }}">{{ $outboundStudent->activityReport()->name }}</a>

                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $outboundStudent->activityReport()) }}')">ลบไฟล์</button>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <label>แนบรายงานการเดินทาง</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachment_travelling_report" id="attachment_travelling_report">
                    <label class="custom-file-label" for="attachment_travelling_report">เลือกไฟล์</label>
                </div>
                @if ($outboundStudent->travellingReport())
                <div class="mt-1">
                    <a href="{{ route('file.show', $outboundStudent->travellingReport()) }}">{{ $outboundStudent->travellingReport()->name }}</a>

                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $outboundStudent->travellingReport()) }}')">ลบไฟล์</button>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <label>แนบไฟล์อื่น ๆ</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachment_other" id="attachment_other">
                    <label class="custom-file-label" for="attachment_other">เลือกไฟล์</label>
                </div>
                @if ($outboundStudent->attachment())
                <div class="mt-1">
                    <a href="{{ route('file.show', $outboundStudent->attachment()) }}">{{ $outboundStudent->attachment()->name }}</a>

                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $outboundStudent->attachment()) }}')">ลบไฟล์</button>
                </div>
                @endif
            </div>
        </div>
        <!-- End of Uni -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('outbound-student.show', $outboundStudent) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function removeFile(action) {
            if (confirm("ต้องการลบไฟล์นี้ใช่หรอไม่")) {
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

@section('script')
<script src="{{ asset('js/outbound-student.create.js') }}" defer></script>
@endsection