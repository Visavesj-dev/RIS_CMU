@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('document.index') }}">โหลดเอกสาร</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $document->name }}</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">โหลดเอกสาร</h1>

    <hr>

    <dl class="row">
        <dt class="col-md-3 col-lg-2">ชื่อเอกสาร</dt>
        <dd class="col-md-9">{{ $document->name }}</dd>

        <dt class="col-md-3 col-lg-2">รายละเอียด</dt>
        <dd class="col-md-9">{{ $document->description }}</dd>

        <dt class="col-md-3 col-lg-2">ประเภท</dt>
        <dd class="col-md-9">
            {{ $document->research ? "วิจัย " : "" }}
            {{ $document->service ? "บริการวิชาการ " : "" }}
            {{ $document->foreign ? "วิเทศสัมพันธ์ " : "" }}
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์แนบ</dt>
        <dd class="col-md-9">
            @if ($document->attachment)
            <a href="{{ route('file.show', $document->attachment) }}">{{ $document->attachment->name }}</a>
            @else
            ไม่มีไฟล์แนบ
            @endif
        </dd>
    </dl>

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('document.edit', $document) }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
            </div>
        </div>
    </div>
    
</div>

<div class="embed-responsive mb-4" id="guest-container">
    <iframe class="embed-responsive-item" src="{{ route('guest.index', $document) }}"></iframe>
</div>

<div class="embed-responsive mb-4" id="host-container">
    <iframe class="embed-responsive-item" src="{{ route('host.index', $document) }}"></iframe>
</div>

@endsection

@section('script')
<script src="{{ asset('js/document.iframe.js') }}" defer></script>
@endsection
