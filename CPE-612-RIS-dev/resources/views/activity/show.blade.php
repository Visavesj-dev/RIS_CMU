@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('activity.index') }}">กิจกรรม</a></li>   
        <li class="breadcrumb-item active" aria-current="page">#{{ $activity->id }}</li>
    </ol>
</nav>

<!-- MoA -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">กิจกรรม#{{ $activity->id }} {{ $activity->title }}</h1>

    <!-- Detail -->
    <dl class="row">
        <dt class="col-md-3 col-lg-2">อยู่ภายใต้</dt>
        @if ($activity->parent instanceof App\Mou)
        <dd class="col-md-9"><a href="{{ route('mou.show', $activity->parent) }}">
            MoU#{{ $activity->parent->id }} {{ $activity->parent->partners->first()->name }}</a></dd>
        @else
        <dd class="col-md-9"><a href="{{ route('moa.show', $activity->parent) }}">
            MoA#{{ $activity->parent->id }} {{ $activity->parent->title }}</a></dd>
        @endif

        <dt class="col-md-3 col-lg-2">ผู้รับผิดชอบ</dt>
        <dd class="col-md-9">{{ $activity->lecturer->fullname }} ({{ $activity->lecturer->major }})</dd>

        <dt class="col-md-3 col-lg-2">กิจกรรม</dt>
        <dd class="col-md-9">
            <ul class="list-unstyled">
                @foreach ($activity->programs as $program)
                <li>{{ $program->name }}</li>
                @endforeach
                @if ($activity->otherProgram()->exists())
                <li>{{ $activity->otherProgram->name }}</li>
                @endif
            </ul>
        </dd>

        <dt class="col-md-3 col-lg-2">รายละเอียด</dt>
        <dd class="col-md-9">
            <p>{{ $activity->detail }}<p>
        </dd>

        <dt class="col-md-3 col-lg-2">วันเริ่มต้น</dt>
        <dd class="col-md-9">
            <p>{{ $activity->started_at->format('j M Y') }}</p>
        </dd>

        <dt class="col-md-3 col-lg-2">วันสิ้นสุด</dt>
        <dd class="col-md-9">
            <p>{{ $activity->ended_at->format('j M Y') }}</p>
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์แนบ</dt>
        <dd class="col-md-9">
            @if ($activity->attachment()->exists())
            <a href="{{ route('file.show', $activity->attachment) }}">{{ $activity->attachment->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>
    </dl>
    <!-- End of Detail -->

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="d-flex flex-row-reverse">
                <a href="/activity/{{ $activity->id }}/edit" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
            </div>
        </div>
    </div>

</div>
<!-- End of MoA -->

@endsection
