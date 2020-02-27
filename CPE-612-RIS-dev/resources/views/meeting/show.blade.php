@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('meeting.index') }}">ประชุมวิชาการ</a></li>
        <li class="breadcrumb-item active" aria-current="page">#{{ $meeting->id }}</li>
    </ol>
</nav>

<!-- Meeting -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">ประชุมวิชาการ #{{ $meeting->id }} {{ $meeting->title }}</h1>

    <!-- Detail -->
    <dl class="row">
        <dt class="col-md-3 col-lg-2">หัวข้อการประชุม</dt>
        <dd class="col-md-9">
            {{ $meeting->title }}
        </dd>

        <dt class="col-md-3 col-lg-2">วันที่เริ่มต้น</dt>
        <dd class="col-md-9">{{ $meeting->started_at->format('j M Y') }}</dd>

        <dt class="col-md-3 col-lg-2">วันที่สิ้นสุด</dt>
        <dd class="col-md-9">{{ $meeting->ended_at->format('j M Y') }}</dd>

        <dt class="col-md-3 col-lg-2">หัวหน้าโครงการ</dt>
        <dd class="col-md-9">
            {{ $meeting->head_of_project }}
        </dd>

        <dt class="col-md-3 col-lg-2">ภาควิชา</dt>
        <dd class="col-md-9">
            {{ $meeting->department->name }}
        </dd>

        <dt class="col-md-3 col-lg-2">งบประมาณ</dt>
        <dd class="col-md-9">
            {{ $meeting->budget }}
        </dd>

        <dt class="col-md-3 col-lg-2">สภานที่จัดงานประชุม</dt>
        <dd class="col-md-9">
            {{ $meeting->meeting_place }}
        </dd>

        <dt class="col-md-3 col-lg-2">มอบอำนาจ</dt>
        <dd class="col-md-9">
            <ul class="list-inline">
                @if ($meeting->authorize_financial)
                <li class="list-inline-item">
                    เจ้าหน้าที่การเงินและออกใบเสร็จ
                </li>
                @endif
                @if ($meeting->authorize_other)
                <li class="list-inline-item">{{ $meeting->authorize_other }}</li>
                @endif
            </ul>
        </dd>

        <dt class="col-md-3 col-lg-2">พรบ. จัดซื้อจัดจ้าง</dt>
        <dd class="col-md-9">
            {{ $meeting->procurement_act }}
        </dd>
    </dl>

    
    @if ($meeting->closed_at)
    <hr>
    <h2 class="pt-4">สรุปผล</h1>

    <!-- Detail -->
    <dl class="row">
        <dt class="col-md-3 col-lg-2">ปิดโครงการวันที่</dt>
        <dd class="col-md-9">
            {{ $meeting->closed_at->format('j M Y') }}
        </dd>

        <dt class="col-md-3 col-lg-2">ประมาณการรายรับ</dt>
        <dd class="col-md-9">
            {{ $meeting->expect_income }} บาท
        </dd>

        <dt class="col-md-3 col-lg-2">รายรับจริง</dt>
        <dd class="col-md-9">
            {{ $meeting->actual_income }} บาท
        </dd>

        <dt class="col-md-3 col-lg-2">รายจ่ายจริง</dt>
        <dd class="col-md-9">
            {{ $meeting->actual_expenses }} บาท
        </dd>

        <dt class="col-md-3 col-lg-2">รายรับหักรายจ่าย</dt>
        <dd class="col-md-9">
            {{ $meeting->net_income }} บาท
        </dd>

        <dt class="col-md-3 col-lg-2">แบ่งส่วนรายได้</dt>
        <dd class="col-md-9">
            <dl class="row">
                <dt class="col-sm-4">มช.</dt>
                <dd class="col-sm-8">{{ $meeting->university_share }} บาท</dd>

                <dt class="col-sm-4">คณะ</dt>
                <dd class="col-sm-8">{{ $meeting->faculty_share }} บาท</dd>

                <dt class="col-sm-4">ภาควิชา</dt>
                <dd class="col-sm-8">{{ $meeting->department_share }} บาท</dd>
            </dl>
        </dd>

        @if ($meeting->note)
        <dt class="col-md-3 col-lg-2">หมายเหตุ</dt>
        <dd class="col-md-9">
            <p>{{ $meeting->note }}</p>
        </dd>
        @endif

        @if ($meeting->outcome)
        <dt class="col-md-3 col-lg-2">รายละเอียดผลลัพธ์</dt>
        <dd class="col-md-9">
            <p>q{{ $meeting->outcome }}</p>
        </dd>
        @endif

        <dt class="col-md-3 col-lg-2">ไฟล์แนบ</dt>
        <dd class="col-md-9">
            <dl class="row">
                <dt class="col-sm-4">รายงานผลการประชุม</dt>
                <dd class="col-sm-8">
                    <a href="{{ route('file.show', $meeting->meetingSummary()) }}">{{ $meeting->meetingSummary()->name }}</a>
                </dd>

                <dt class="col-sm-4">รายงานการเงิน</dt>
                <dd class="col-sm-8">
                    <a href="{{ route('file.show', $meeting->meetingFinancialReport()) }}">{{ $meeting->meetingFinancialReport()->name }}</a>
                </dd>
            </dl>
        </dd>
    </dl>
    @endif
    <!-- End of Detail -->

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="d-flex flex-row-reverse">
                @if (! $meeting->closed_at)
                <a href="{{ route('meeting.edit', $meeting) }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
                @endif
                <a href="{{ route('meeting-conclude.edit', $meeting) }}" class="btn btn-primary mt-3 mb-4 mr-2">
                @if ($meeting->closed_at)
                    สรุปผลใหม่
                @else
                    สรุปผล
                @endif
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End of Meeting -->

<div class="embed-responsive mb-4" id="budget-container">
    <iframe class="embed-responsive-item" src="{{ route('meeting-budget.index', $meeting) }}"></iframe>
</div>
@endsection

@section('script')
<script src="{{ asset('js/meeting.iframe.js') }}" defer></script>
@endsection