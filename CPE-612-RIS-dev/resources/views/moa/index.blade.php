@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item active" aria-current="page">MoA</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-6">
            <h1>MoA</h1>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('moa.create') }}" class="btn btn-primary rounded" href="#">สร้าง</a>
            </div>
        </div>
    </div>

    <form class="form-inline" method="GET" id="filter">
        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text">ภาควิชา</span>
            </div>
            <select class="custom-select" id="department" name="department">
                <option value="">ไม่เลือก</option>
                @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ Request::input('department') == $department->id ? 'selected':'' }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

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
                <th scope="col">ภาควิชา</th>
                <th scope="col">ภายใต้ MoU</th>
                <th scope="col">จำนวนกิจกรรม</th>
                <th scope="col">วันเริ่มต้น</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">ตัวเลือก</th>
                

            </tr>
        </thead>
        <tbody>
            @foreach ($moas as $moa)
            <tr class="clickable-row" data-href="{{ route('moa.show', $moa) }}">
                <th scope="row">
                    {{ $moa->id }}
                </th>
                <td>
                    {{ $moa->title }}
                </td>
                <td>
                    @if ($moa->departments()->count() == 9)
                    <h5><span class="badge badge-pill badge-success">ALL</span></h5>
                    @else
                        @foreach ($moa->departments as $department)
                        <h5><span class="badge badge-pill badge-info">{{ $department->name }}</span></h5>
                        @endforeach
                    @endif

                    @if ($moa->otherDepartment)
                    <h5><span class="badge badge-pill badge-secondary">{{ $moa->otherDepartment->name }}</span></h5>
                    @endif
                </td>
                <td>
                    @if ($moa->mou()->exists())
                        <a href="{{ route('mou.show', $moa->mou) }}">#{{ $moa->mou->id }} {{ $moa->mou->partners->first()->name }}</a>
                    @endif
                </td>
                <td>{{ $moa->activities()->count() }}</td>
                <td>{{ $moa->started_atc }}</td>
                <td>{{ $moa->ended_at->format('j M Y') }}</td>
                <td>
                    <form action="{{ route('moa.destroy', $moa) }}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf

                        <a href="{{ route('moa.edit', $moa) }}" class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/moa.list.js') }}" defer></script>
@endsection