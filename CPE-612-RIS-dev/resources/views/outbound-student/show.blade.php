@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('outbound-student.index') }}">นักศึกษาไทย</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $outboundStudent->full_name }}</li>
    </ol>
</nav>

<!-- MoA -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">นักศึกษาไทย </h1>

    <hr>
    <h4>{{ $outboundStudent->full_name }}</h2>

    <!-- Detail -->
    <dl class="row">
        <dt class="col-md-3 col-lg-2">ประเภท</dt>
        <dd class="col-md-9">{{ $outboundStudent->type->name }}</dd>

        <dt class="col-md-3 col-lg-2">รหัสนักศึกษา</dt>
        <dd class="col-md-9">{{ $outboundStudent->student_id ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">ภาควิชา</dt>
        <dd class="col-md-9">{{ $outboundStudent->department->name }}</dd>

        <dt class="col-md-3 col-lg-2">อาจารย์ที่ปรึกษา</dt>
        <dd class="col-md-9">{{ $outboundStudent->advisor->fullname }}</dd>

        <dt class="col-md-3 col-lg-2">เบอร์ติดต่อ</dt>
        <dd class="col-md-9">{{ $outboundStudent->telephone ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">อีเมล</dt>
        <dd class="col-md-9">{{ $outboundStudent->email }}</dd>

        <dt class="col-md-3 col-lg-2">เลขที่หนังสือเดินทาง</dt>
        <dd class="col-md-9">{{ $outboundStudent->passport_id }}</dd>
    </dl>
   
    <hr>
   
    <h4>โครงการ</h4>
    <dl class="row">
        <dt class="col-md-3 col-lg-2">ความร่วมมือ</dt>
        <dd class="col-md-9">{{ $outboundStudent->cooperation_name ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">โครงการ</dt>
        <dd class="col-md-9">{{ $outboundStudent->project ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">มหาวิทยาลัยต้นทาง</dt>
        <dd class="col-md-9">{{ $outboundStudent->university ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">ผู้ประสานงาน</dt>
        <dd class="col-md-9">{{ $outboundStudent->coordinator_name ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">อีเมลผู้ปะสานงาน</dt>
        <dd class="col-md-9">{{ $outboundStudent->coordinator_email ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">วันที่เดินทางไป</dt>
        <dd class="col-md-9">
            @if ($outboundStudent->travelled_at)
            {{ $outboundStudent->travelled_at->format('j M Y') }}
            @else 
            ไม่มีข้อมูล
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">วันที่เดินทางกลับ</dt>
        <dd class="col-md-9">
            @if ($outboundStudent->returned_at)
            {{ $outboundStudent->returned_at->format('j M Y') }}
            @else 
            ไม่มีข้อมูล
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">วิชาที่เรียน</dt>
        <dd class="col-md-9">{{ $outboundStudent->degree ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">ที่พัก</dt>
        <dd class="col-md-9">{{ $outboundStudent->accommodation ?? 'ไม่มีข้อมูล'  }}</dd>

        <dt class="col-md-3 col-lg-2">หมายเหตุ</dt>
        <dd class="col-md-9">
            <p>{{ $outboundStudent->note ?? 'ไม่มี'  }}<p>
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์รูปถ่าย</dt>
        <dd class="col-md-9">
            @if ($outboundStudent->photo())
            <a href="{{ route('file.show', $outboundStudent->photo()) }}">{{ $outboundStudent->photo()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์หนังสือเดินทาง</dt>
        <dd class="col-md-9">
            @if ($outboundStudent->passport())
            <a href="{{ route('file.show', $outboundStudent->passport()) }}">{{ $outboundStudent->passport()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์รายงานโครงการ</dt>
        <dd class="col-md-9">
            @if ($outboundStudent->activityReport())
            <a href="{{ route('file.show', $outboundStudent->activityReport()) }}">{{ $outboundStudent->activityReport()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์รายงานการเดินทาง</dt>
        <dd class="col-md-9">
            @if ($outboundStudent->travellingReport())
            <a href="{{ route('file.show', $outboundStudent->travellingReport()) }}">{{ $outboundStudent->travellingReport()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์แนบอื่น ๆ</dt>
        <dd class="col-md-9">
            @if ($outboundStudent->attachment())
            <a href="{{ route('file.show', $outboundStudent->attachment()) }}">{{ $outboundStudent->attachment()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>
    </dl>
    <!-- End of Detail -->

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('outbound-student.edit', $outboundStudent) }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
            </div>
        </div>
    </div>

</div>
<!-- End of MoA -->


<div class="container-fluid bg-white rounded pb-2 mb-4">
    <div class="row">
        <div class="col-md-6">
            <h4 class="pt-4">แหล่งเงินทุน</h4>
        </div>
    </div>

    <hr>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>ประเภท</th>
                <th>ชื่อ</th>
                <th>จำนวน</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($outboundStudent->funds as $fund)
            <tr>
                <td>
                    {{ $loop->index + 1}}
                </td>
                <td>{{ $fund->type->name }}</td>
                <td>{{ $fund->name }}</td>
                <td>{{ $fund->amount }}</td>
                <td>
                    <form action="{{ route('student-fund.destroy', $outboundStudent) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach

            <tr>
                <td>
                    รวม
                </td>
                <td></td>
                <td></td>
                <td>{{ $outboundStudent->funds->reduce(function ($carry, $item) { return $carry + $item->amount; }, 0) }}</td>
                <td>
                </td>
            </tr>

            <tr>
                <form action="{{ route('student-fund.store') }}" method="POST">
                        @csrf
                <td>
                    <input type="hidden" name="outbound_student_id" value="{{ $outboundStudent->id }}">
                </td>
                <td>
                    <select name="student_fund_type_id" class="form-control" required>
                        @foreach ($studentFundTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="name" placeholder="ชื่อแหล่งทุน" required>
                </td>
                <td>
                    <input type="number" step="any" class="form-control" name="amount" placeholder="จำนวน" required>
                </td>
                <td>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></button>
                </td>
                </form>
            </tr>
            
        </tbody>
    </table>
</div>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <form action="{{ route('outbound-student.check', $outboundStudent) }}" method="POST">
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
                            <input class="form-check-input" type="checkbox" name="checks[]" value="{{ $check->id }}" {{ $outboundStudent->checklist->contains($check) ? 'checked':'' }}>
                        </div>
                    </td>
                    <td>{{ $check->name }}</td>
                    <td>{{ $outboundStudent->checklist->find($check)['pivot']['created_at'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>

</div>

@endsection
