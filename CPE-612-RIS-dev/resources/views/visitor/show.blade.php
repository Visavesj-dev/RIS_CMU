@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('visitor.index') }}">อาคันตุกะ</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $visitor->university }}</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">อาคันตุกะ</h1>

    <hr>

    <dl class="row">
        <dt class="col-md-3 col-lg-2">มหาวิทยาลัย</dt>
        <dd class="col-md-9">{{ $visitor->university }}</dd>

        <dt class="col-md-3 col-lg-2">ประเทศ</dt>
        <dd class="col-md-9">{{ $visitor->country->name }}</dd>

        <dt class="col-md-3 col-lg-2">วันเริ่มต้น</dt>
        <dd class="col-md-9">{{ $visitor->started_at->format('j M Y') }}</dd>

        <dt class="col-md-3 col-lg-2">วันสิ้นสุด</dt>
        <dd class="col-md-9">{{ $visitor->ended_at->format('j M Y') }}</dd>

        <dt class="col-md-3 col-lg-2">วันเข้าพบ</dt>
        <dd class="col-md-9">{{ $visitor->visited_at->format('j M Y') }}</dd>

        <dt class="col-md-3 col-lg-2">รายละเอียด</dt>
        <dd class="col-md-9">{{ $visitor->description }}</dd>

        <dt class="col-md-3 col-lg-2">หมายเหตุ</dt>
        <dd class="col-md-9">{{ $visitor->note ?? 'ไม่มีข้อมูล' }}</dd>

        <dt class="col-md-3 col-lg-2">ไฟล์รูปถ่ายรวม</dt>
        <dd class="col-md-9">
            @if ($visitor->attachment_group_photo())
            <a href="{{ route('file.show', $visitor->attachment_group_photo()) }}">{{ $visitor->attachment_group_photo()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์รูปของที่ระลึก</dt>
        <dd class="col-md-9">
            @if ($visitor->attachment_memento())
            <a href="{{ route('file.show', $visitor->attachment_memento()) }}">{{ $visitor->attachment_memento()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์สรุปการประชุม</dt>
        <dd class="col-md-9">
            @if ($visitor->attachment_meeting_summary())
            <a href="{{ route('file.show', $visitor->attachment_meeting_summary()) }}">{{ $visitor->attachment_meeting_summary()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์อื่นๆ</dt>
        <dd class="col-md-9">
            @if ($visitor->attachment_other())
            <a href="{{ route('file.show', $visitor->attachment_other()) }}">{{ $visitor->attachment_other()->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>
    </dl>

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('visitor.edit', $visitor) }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
            </div>
        </div>
    </div>

</div>


<div class="embed-responsive mb-4" id="guest-container">
    <iframe class="embed-responsive-item" src="{{ route('guest.index', $visitor) }}"></iframe>
</div>

<div class="embed-responsive mb-4" id="host-container">
    <iframe class="embed-responsive-item" src="{{ route('host.index', $visitor) }}"></iframe>
</div>


@endsection

@section('script')
<script src="{{ asset('js/visitor.iframe.js') }}" defer></script>
@endsection