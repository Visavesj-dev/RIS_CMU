@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('inbound-student.index') }}">นักศึกษาต่างชาติ</a></li>        
        <li class="breadcrumb-item"><a href="{{ route('inbound-student.show', $inboundStudent) }}">{{ $inboundStudent->full_name }}</a></li>        
        <li class="breadcrumb-item active" aria-current="page">แก้ไข</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไขนักศึกษาต่างชาติ {{ $inboundStudent->full_name }}</h1>

    <!-- Start Form -->
    <form action="{{ route('inbound-student.update', $inboundStudent) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                        <option value="{{ $type->id }}" {{ $inboundStudent->student_type_id == $type->id ? 'selected':'' }}>
                            {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>คำนำหน้าชื่อ</label>
                    <select class="custom-select" name="prefix" required>
                        <option value="Mr" {{ $inboundStudent->prefix == "Mr" ? 'selected':'' }}>Mr</option>
                        <option value="Mrs" {{ $inboundStudent->prefix == "Mrs" ? 'selected':'' }}>Mrs</option>
                        <option value="Ms" {{ $inboundStudent->prefix == "Ms" ? 'selected':'' }}>Ms</option>
                        <option value="Dr" {{ $inboundStudent->prefix == "Dr" ? 'selected':'' }}>Dr</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ชื่อจริง</label>
                    <input type="text" class="form-control" name="first_name" required value="{{ $inboundStudent->first_name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>นามสกุล</label>
                    <input type="text" class="form-control" name="last_name" required value="{{ $inboundStudent->last_name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>มหาวิทยาลัยต้นทาง</label>
                    <input type="text" class="form-control" name="university" list="universities" required value="{{ $inboundStudent->university }}">

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
                    <label>ประเทศ</label>
                    <input type="text" class="form-control" name="country" list="countries" required value="{{ $inboundStudent->country->name }}">
                    <datalist id="countries">
                        @foreach ($countries as $country)
                        <option value="{{ $country->name }}"></option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>อีเมล</label>
                    <input type="email" class="form-control" name="email" required value="{{ $inboundStudent->email }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>เลขที่หนังสือเดินทาง</label>
                    <input type="text" class="form-control" name="passport_id" required value="{{ $inboundStudent->passport_id }}">
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
                    <input type="text" class="form-control" name="cooperation_name" required value="{{ $inboundStudent->cooperation_name }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ชื่อโครงการ</label>
                    <input type="text" class="form-control" name="project" required value="{{ $inboundStudent->project }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>วันที่เดินทางถึงไทย</label>
                    <input type="date" class="form-control" name="arrived_at" required value="{{ $inboundStudent->arrived_at->format('Y-m-d') }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>วันที่เดินทางกลับ</label>
                    <input type="date" class="form-control" name="departed_at" required value="{{ $inboundStudent->departed_at->format('Y-m-d') }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ภาควิชา</label>
                    <select class="form-control" name="department_id" required>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $inboundStudent->department_id == $department->id ? 'selected':'' }}>
                            {{ $department->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>อาจารย์ที่ปรึกษา</label>
                    <select class="form-control" name="lecturer_id" id="advisor-selector" required>
                        @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ $inboundStudent->lecturer_id == $lecturer->id ? 'selected':'' }}>{{ $lecturer->fullname }} ({{ $lecturer->major }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ระดับการศึกษา</label>
                    <select class="custom-select" name="degree" required>
                        <option value="ตรี" {{ $inboundStudent->degree == "ตรี" ? 'selected':'' }}>ตรี</option>
                        <option value="โท" {{ $inboundStudent->degree == "โท" ? 'selected':'' }}>โท</option>
                        <option value="เอก" {{ $inboundStudent->degree == "เอก" ? 'selected':'' }}>เอก</option>
                        <option value="อื่น ๆ" {{ $inboundStudent->degree == "อื่น ๆ" ? 'selected':'' }}>อื่น ๆ</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- End of Cooperation -->

        <hr>

        <!-- Uni -->
        <h4>คณะ <small>(เว้นว่างได้)</small></h4>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>รหัสนักศึกษา</label>
                    <input type="text" class="form-control" name="student_id" value="{{ $inboundStudent->student_id }}">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label>เบอร์ติดต่อในไทย</label>
                    <input type="text" class="form-control" name="telephone" value="{{ $inboundStudent->telephone }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>วิชาที่เรียน</label>
                    <input type="text" class="form-control" name="subject" value="{{ $inboundStudent->subject }}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ที่พัก</label>
                    <input type="text" class="form-control" name="accommodation" value="{{ $inboundStudent->accommodation }}">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>หมายเหตุ</label>
                    <textarea class="form-control" name="note">
                        {{ $inboundStudent->note }}
                    </textarea>
                </div>
            </div>

            <div class="col-md-4">
                <label>แนบรูปถ่าย</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachment_photo">
                    <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
                </div>
                @if ($inboundStudent->photo())
                <div class="mt-1">
                    <a href="{{ route('file.show', $inboundStudent->photo()) }}">{{ $inboundStudent->photo()->name }}</a>

                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $inboundStudent->photo()) }}')">ลบไฟล์</button>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <label>แนบหนังสือเดินทาง</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachment_passport">
                    <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
                </div>
                @if ($inboundStudent->passport())
                <div class="mt-1">
                    <a href="{{ route('file.show', $inboundStudent->passport()) }}">{{ $inboundStudent->passport()->name }}</a>

                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $inboundStudent->passport()) }}')">ลบไฟล์</button>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <label>แนบไฟล์อื่น ๆ</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachment_other">
                    <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
                </div>
                @if ($inboundStudent->attachment())
                <div class="mt-1">
                    <a href="{{ route('file.show', $inboundStudent->attachment()) }}">{{ $inboundStudent->attachment()->name }}</a>

                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile('{{ route('file.destroy', $inboundStudent->attachment()) }}')">ลบไฟล์</button>
                </div>
                @endif
            </div>
        </div>
        <!-- End of Uni -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <button type="reset" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</button>
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
<script src="{{ asset('js/inbound-student.create.js') }}" defer></script>
@endsection