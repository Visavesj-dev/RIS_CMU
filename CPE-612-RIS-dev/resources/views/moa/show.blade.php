@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('mou.index') }}">MoA</a></li>
        <li class="breadcrumb-item active" aria-current="page">#{{ $moa->id }}</li>
    </ol>
</nav>

<!-- MoA -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">MoA #{{ $moa->id }} {{ $moa->title }}</h1>

    <!-- Detail -->
    <dl class="row">
        @if ($moa->mou()->exists())
        <dt class="col-md-3 col-lg-2">อยู่ภายใต้ MoU</dt>
        <dd class="col-md-9">
            <a href="{{ route('mou.show', $moa->mou) }}">
            #{{ $moa->mou->id }} {{ $moa->mou->partners->first()->name }}
            </a>
        </dd>
        @endif

        <dt class="col-md-3 col-lg-2">ภาควิชาที่เกี่ยวข้อง</dt>
        <dd class="col-md-9">
            <ul class="list-unstyled">
                @foreach ($moa->departments as $department)
                <li>{{ $department->name }}</li>
                @endforeach
                @if ($moa->otherDepartment()->exists())
                <li>{{ $moa->otherDepartment->name }}</li>
                @endif
            </ul>
        </dd>

        <dt class="col-md-3 col-lg-2">รายละเอียด</dt>
        <dd class="col-md-9">
            <p>{{ $moa->detail }}<p>
        </dd>

        <dt class="col-md-3 col-lg-2">วันลงนาม</dt>
        <dd class="col-md-9">
            <p>{{ $moa->made_agreement_at->format('j M Y') }}</p>
        </dd>

        <dt class="col-md-3 col-lg-2">วันเริ่มต้น</dt>
        <dd class="col-md-9">
            <p>{{ $moa->started_at->format('j M Y') }}</p>
        </dd>

        <dt class="col-md-3 col-lg-2">วันสิ้นสุด</dt>
        <dd class="col-md-9">
            <p>{{ $moa->ended_at->format('j M Y') }}</p>
        </dd>

        <dt class="col-md-3 col-lg-2">ไฟล์แนบ</dt>
        <dd class="col-md-9">
            @if ($moa->attachment()->exists())
            <a href="{{ route('file.show', $moa->attachment) }}">{{ $moa->attachment->name }}</a>
            @else 
            ไม่มีไฟล์แนบ
            @endif
        </dd>
    </dl>
    <!-- End of Detail -->

    <div class="row">
        <div class="col-md-6 offset-md-10">
            <div class="d-flex flex-row-reverse">
                <a href="/moa/{{ $moa->id }}/edit" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
            </div>
        </div>
    </div>

</div>
<!-- End of MoA -->

<div class="container-fluid bg-white rounded pb-2 mb-4">
    <div class="row pt-4 pb-2">
        <div class="col-md-6">
            <h3>กิจกรรมภายใต้ MoA#{{ $moa->id }}</h3>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('activity.create') }}?parent=moa&moa_id={{ $moa->id }}" class="btn btn-primary">สร้างกิจกรรม</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped" id="activityTable">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">ผู้รับผิดชอบ</th>
                <th scope="col">วันเริ่มต้น</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moa->activities as $activity)
            <tr class="clickable-row" data-href="{{ route('activity.show', $activity) }}">
                <th scope="row">
                    {{ $activity->id }}
                </th>
                <td>
                    {{ $activity->title }}
                </td>
                <td>
                    {{ $activity->lecturer->fullname }}
                </td>
                <td>{{ $activity->started_at->format('j M Y') }}</td>
                <td>{{ $activity->ended_at->format('j M Y') }}</td>
                <td>
                    <form action="{{ route('activity.destroy', $activity) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('activity.edit', $activity) }}" class="btn btn-sm btn-warning btn-circle">
                            <i class="fas fa-edit"></i>
                        </a>

                        <button type="button" class="btn btn-sm btn-danger btn-circle delete-button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('script')
<script src="{{ asset('js/moa.show.js') }}" defer></script>
@endsection