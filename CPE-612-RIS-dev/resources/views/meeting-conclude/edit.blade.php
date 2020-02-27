@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('meeting.index') }}">การประชุมวิชาการ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('meeting.show', $meeting) }}">{{ $meeting->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">สรุป</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <h1 class="pt-4">สรุปประชุมวิชาการ</h1>

    <!-- Start Form -->
    <form action="{{ route('meeting-conclude.update', $meeting) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input autocomplete="false" type="text" style="display:none;">
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

        <dl class="row">
            <dt class="col-md-3 col-lg-2">หัวข้อการประชุม</dt>
            <dd class="col-md-9">
                {{ $meeting->title }}
            </dd>

            <dt class="col-md-3 col-lg-2">รายรับจริง</dt>
            <dd class="col-md-9">
                {{ number_format($meeting->budgets->sum('actual_amount'), 2) }}
            </dd>
        </dl>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>รายจ่ายจริง</label>
                    <input type="text" class="form-control" name="actual_expenses" value="{{ $meeting->actual_expenses }}" required onchange="calculateNetIncome(this)">
                </div>
            </div>

            <script>
                let actualIncome = {{ $meeting->budgets->sum('actual_amount') }}

                function calculateNetIncome(e) {
                    let netIncomeElement = document.getElementById('net_income')

                    netIncomeElement.value = actualIncome - e.value
                }
            </script>

            <div class="col-md-4">
                <div class="form-group">
                    <label>รายรับหักรายจ่าย</label>
                    <input type="text" class="form-control" name="net_income" id="net_income" value="{{ $meeting->net_income }}" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>วันที่ปิดโครงการ</label>
                    <input type="date" class="form-control" name="closed_at" value="{{ optional($meeting->closed_at)->format('Y-m-d') }}" required>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="form-group">
                    <label>ส่งเงินรายได้ มช.</label>
                    <input type="number" class="form-control" name="university_share" value="{{ $meeting->university_share }}" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ส่งเงินรายได้ คณะ</label>
                    <input type="number" class="form-control" name="faculty_share" value="{{ $meeting->faculty_share }}" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ส่งเงินรายได้ ภาควิชา</label>
                    <input type="number" class="form-control" name="department_share" value="{{ $meeting->department_share }}" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>เหตุผล</label>
                    <input type="text" class="form-control" value="{{ $meeting->note }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>แนบไฟล์รายงานโครงการ</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="meeting_summary" {{ $meeting->meetingSummary() ? '':'required' }}>
                        <label class="custom-file-label">เลือกไฟล์</label>
                    </div>
                    @if ($meeting->meetingSummary())
                    <div class="mt-1">
                        <a href="{{ route('file.show', $meeting->meetingSummary()) }}">{{ $meeting->meetingSummary()->name }}</a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>แบบไฟล์รายงานการเงิน</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="meeting_financial_report" {{ $meeting->meetingFinancialReport() ? '':'required' }}>
                        <label class="custom-file-label">เลือกไฟล์</label>
                    </div>
                    @if ($meeting->meetingFinancialReport())
                    <div class="mt-1">
                        <a href="{{ route('file.show', $meeting->meetingFinancialReport()) }}">{{ $meeting->meetingFinancialReport()->name }}</a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">    
                    <label>รายละเอียดผลลัพธ์</label>
                    <textarea class="form-control" name="outcome" rows="5">{{ $meeting->outcome }}</textarea>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('meeting.show', $meeting) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">สรุป</button>
                </div>
            </div>
        </div>
    </form>
</div>



@endsection