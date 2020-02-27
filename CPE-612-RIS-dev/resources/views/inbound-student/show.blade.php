@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('inbound-student.index') }}">นักศึกษาต่างชาติ</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $inboundStudent->full_name }}</li>
    </ol>
</nav>

<!-- MoA -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">นักศึกษาต่างชาติ </h1>

    <hr>
    <h4>{{ $inboundStudent->full_name }}</h2>

    <!-- Detail -->
    <dl class="row">
        <dt class="col-md-3 col-lg-2">ประเภท</dt>
        <dd class="col-md-9">{{ $inboundStudent->type->name }}</dd>

        <dt class="col-md-3 col-lg-2">มหาวิทยาลัยต้นทาง</dt>
        <dd class="col-md-9">{{ $inboundStudent->university }}</dd>

        <dt class="col-md-3 col-lg-2">ประเทศ</dt>
        <dd class="col-md-9">{{ $inboundStudent->country->name }}</dd>

        <dt class="col-md-3 col-lg-2">อีเมล</dt>
        <dd class="col-md-9">{{ $inboundStudent->email }}</dd>

        <dt class="col-md-3 col-lg-2">เลขที่หนังสือเดินทาง</dt>
        <dd class="col-md-9">{{ $inboundStudent->passport_id }}</dd>
    </dl>
   
    <hr>
   
    <h4>โครงการ</h4>
    <dl class="row">
        <dt class="col-md-3 col-lg-2">ความร่วมมือ</dt>
        <dd class="col-md-9">{{ $inboundStudent->cooperation_name }}</dd>

        <dt class="col-md-3 col-lg-2">โครงการ</dt>
        <dd class="col-md-9">{{ $inboundStudent->project }}</dd>

        <dt class="col-md-3 col-lg-2">ภาควิชา</dt>
        <dd class="col-md-9">{{ $inboundStudent->department->name }}</dd>

        <dt class="col-md-3 col-lg-2">อาจารย์ที่ปรึกษา</dt>
        <dd class="col-md-9">{{ $inboundStudent->advisor->fullname }}</dd>

        <dt class="col-md-3 col-lg-2">ระดับที่ศึกษา</dt>
        <dd class="col-md-9">{{ $inboundStudent->degree }}</dd>

        <dt class="col-md-3 col-lg-2">วันที่มาถึง</dt>
        <dd class="col-md-9">
            {{ $inboundStudent->arrived_at->format('j M Y') }}
        </dd>

        <dt class="col-md-3 col-lg-2">วันที่เดินทางกลับ</dt>
        <dd class="col-md-9">
            {{ $inboundStudent->departed_at->format('j M Y') }}
        </dd>
    </dl>
   
    <hr>
   
    <h4>คณะ</h4>
    <dl class="row">
        <dt class="col-md-3 col-lg-2">รหัสนักศึกษา</dt>
        <dd class="col-md-9">{{ $inboundStudent->student_id ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">เบอร์ติดต่อในไทย</dt>
        <dd class="col-md-9">{{ $inboundStudent->telephone ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">วันที่วีซ่าหมดอายุ</dt>
        <dd class="col-md-9">{{ $inboundStudent->latestVisaExpirationDate() ? 
            $inboundStudent->latestVisaExpirationDate()->expired_at->format('j M Y') : 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">วันที่รายงานตัวที่พัก</dt>
        <dd class="col-md-9">{{ $inboundStudent->latestReportAccommodationDate() ?
            $inboundStudent->latestReportAccommodationDate()->reported_at->format('j M Y') : 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">วิชาที่เรียน</dt>
        <dd class="col-md-9">{{ $inboundStudent->degree ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">ที่พัก</dt>
        <dd class="col-md-9">{{ $inboundStudent->accommodation ?? 'ไม่มีข้อมูล'  }}</dd>

        <dt class="col-md-3 col-lg-2">หมายเหตุ</dt>
        <dd class="col-md-9">
            <p>{{ $inboundStudent->note ?? 'ไม่มี'  }}<p>
        </dd>

        <dt class="col-md-3 col-lg-2">วันที่เดินทางกลับ</dt>
        <dd class="col-md-9">
            {{ $inboundStudent->departed_at->format('j M Y') }}
        </dd>


        <dt class="col-md-3 col-lg-2">ไฟล์รูปถ่าย</dt>
        <dd class="col-md-9">
            @if ($inboundStudent->photo())
            <a href="{{ route('file.show', $inboundStudent->photo()) }}">{{ $inboundStudent->photo()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์หนังสือเดินทาง</dt>
        <dd class="col-md-9">
            @if ($inboundStudent->passport())
            <a href="{{ route('file.show', $inboundStudent->passport()) }}">{{ $inboundStudent->passport()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์แนบอื่น ๆ</dt>
        <dd class="col-md-9">
            @if ($inboundStudent->attachment())
            <a href="{{ route('file.show', $inboundStudent->attachment()) }}">{{ $inboundStudent->attachment()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>
    </dl>
    <!-- End of Detail -->

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('inbound-student.edit', $inboundStudent) }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
            </div>
        </div>
    </div>

</div>
<!-- End of MoA -->

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <form action="{{ route('inbound-student.check', $inboundStudent) }}" method="POST">
    <!-- head -->
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h4 class="pt-4">ตรวจสอบ </h4>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-row-reverse">
                    <button class="btn btn-primary mt-3">บันทึก</button>
                </div>
            </div>
        </div>

    
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รายการ</th>
                    <th>เมื่อ</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($checklist as $check)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="checks[]" value="{{ $check->id }}" {{ $inboundStudent->checklist->contains($check) ? 'checked':'' }}>
                        </div>
                    </td>
                    <td>{{ $check->name }}</td>
                    <td>{{ $inboundStudent->checklist->find($check)['pivot']['created_at'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>

</div>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <div class="row">
        <div class="col-md-6">
            <h4 class="pt-4">วันที่ต่ออายุวีซ่า และรายงานตัวแจ้งที่พัก 90 วัน</h4>
        </div>
    </div>

    <hr>

    <dl class="row">
        <dt class="col-md-3 col-lg-2">ชื่อ</dt>
        <dd class="col-md-9">{{ $inboundStudent->full_name }}</dd>

        <dt class="col-md-3 col-lg-2">เลขที่หนังสือเดินทาง</dt>
        <dd class="col-md-9">{{ $inboundStudent->passport_id }}</dd>

        <dt class="col-md-3 col-lg-2">ประเทศ</dt>
        <dd class="col-md-9">{{ $inboundStudent->country->name }}</dd>

        <dt class="col-md-3 col-lg-2">ความร่วมมือ</dt>
        <dd class="col-md-9">{{ $inboundStudent->cooperation_name }}</dd>

        <dt class="col-md-3 col-lg-2">โครงการ</dt>
        <dd class="col-md-9">{{ $inboundStudent->project }}</dd>

        <dt class="col-md-3 col-lg-2">วันที่มาถึง</dt>
        <dd class="col-md-9">
            {{ $inboundStudent->arrived_at->format('j M Y') }}
        </dd>

        <dt class="col-md-3 col-lg-2">วันที่เดินทางกลับ</dt>
        <dd class="col-md-9">
            {{ $inboundStudent->departed_at->format('j M Y') }}
        </dd>
    </dl>

    <div class="row">
        <div class="col-md-6">
            <h5>วีซ่าที่วีซ่าหมดอายุ</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>วันที่</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($inboundStudent->visaExpirationDates as $visa)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <form action="{{ route('visa-expiration.destroy', $visa) }}" method="POST" class="input-group">
                                @csrf
                                @method('DELETE')
                                <div class="form-control">{{ $visa->expired_at->format('j M Y') }}</div>
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-danger">ลบ</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>
                            <form action="{{ route('visa-expiration.store') }}" method="POST" class="input-group">
                                @csrf
                                <input type="date" class="form-control" name="expired_at">
                                <input type="hidden" name="inbound_student_id" value="{{ $inboundStudent->id }}">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary">เพิ่ม</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h5>รายงานต้วแจ้งที่พัก</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>วันที่</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($inboundStudent->reportAccommodationDates as $report)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            <form action="{{ route('accommodation-report.destroy', $report) }}" method="POST" class="input-group">
                                @csrf
                                @method('DELETE')
                                <div class="form-control">{{ $report->reported_at->format('j M Y') }}</div>
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-danger">ลบ</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>
                            <form action="{{ route('accommodation-report.store') }}" method="POST" class="input-group">
                                @csrf
                                <input type="date" class="form-control" name="reported_at">
                                <input type="hidden" name="inbound_student_id" value="{{ $inboundStudent->id }}">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary">เพิ่ม</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
