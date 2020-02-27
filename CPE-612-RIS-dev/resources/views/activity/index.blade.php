@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item active" aria-current="page">กิจกรรม</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    
    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-10">
            <h1>กิจกรรม</h1>
        </div>
    </div>

    <form class="form-inline" method="GET" id="filter">
        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text">วันที่</span>
            </div>
            <input type="date" class="form-control" name="from" id="fromDate" value="{{ Request::input('from') }}">
            <input type="date" class="form-control" name="to" id="toDate" value="{{ Request::input('to') }}">
        </div>

        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text">สถานะ</span>
            </div>
            <select class="custom-select" id="status" name="status">
                <option value="unexpired">ดำเนินการอยู่</option>
                <option value="expired" {{ Request::input('status') == "expired" ? 'selected':'' }}>หมดอายุ</option>
                <option value="all" {{ Request::input('status') == "all" ? 'selected':'' }}>ทั้งหมด</option>
            </select>
        </div>

        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <input class="form-control" type="text" id="search" name="search" value="{{ Request::input('search') }}" placeholder="คำค้นหา">
            <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">ค้นหา</button>
            </div>
        </div>
    </form>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">ผู้รับผิดชอบ</th>
                <th scope="col">ภายใต้</th>
                <th scope="col">วันเริ่มต้น</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
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
                <td>
                    @if ($activity->parent()->exists())
                        @if ($activity->parent instanceof App\Mou)
                        <a href="{{ route('mou.show', $activity->parent) }}">MoU#{{ $activity->parent->id }} {{ $activity->parent->partners->first()->name }}</a>
                        @else
                        <a href="{{ route('moa.show', $activity->parent) }}">MoA#{{ $activity->parent->id }} {{ $activity->parent->title }}</a>
                        @endif
                    @endif
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
<script src="{{ asset('js/activity.list.js') }}" defer></script>
@endsection
