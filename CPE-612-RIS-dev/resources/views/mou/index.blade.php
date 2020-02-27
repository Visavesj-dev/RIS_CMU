@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item active" aria-current="page">MoU</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>MoU</h1>
        </div>
        <div class="col-md-8 ">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('mou.create') }}" class="btn btn-primary rounded" href="#">สร้าง</a>
            </div>
        </div>
    </div>

    <form class="form-inline" method="GET" id="filter">
        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text">ประเภทข้อตกลง</span>
            </div>
            <select class="custom-select" id="type" name="type">
                <option value="">ไม่เลือก</option>
                @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ Request::input('type') == $type->id ? 'selected':'' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

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
                <button type="submit" class="btn btn-secondary ">ค้นหา</button>
            </div>
        </div>

    </form>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">หน่วยงานที่เข้าร่วม</th>
                <th scope="col">ภาควิชา</th>
                <th scope="col">MoA</th>
                <th scope="col"><span>กิจ<br>กรรม<span></th>
                <th scope="col">วันเริ่มต้น</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mous as $mou)
            <tr class="clickable-row" data-href="{{ route('mou.show', $mou) }}">
                <th scope="row">
                    <a href="{{ route('mou.show', $mou) }}">{{ $mou->id }}</a>
                </th>
                <td>
                    <ul class="list-unstyled">
                    @foreach ($mou->partners as $partner)
                    <li>{{ $partner->name }} <span class="badge badge-pill badge-info">{{ $partner->country->name }}</span></li>
                    @endforeach
                    <ul class="list-unstyled">
                </td>
                <td>
                    @if ($mou->departments()->count() == 9)
                    <h5><span class="badge badge-pill badge-success">ALL</span></h5>
                    @else
                        @foreach ($mou->departments as $department)
                        <h5><span class="badge badge-pill badge-info">{{ $department->name }}</span></h5>
                        @endforeach
                    @endif

                    @if ($mou->otherDepartment)
                    <h5><span class="badge badge-pill badge-secondary">{{ $mou->otherDepartment->name }}</span></h5>
                    @endif
                </td>
                <td>{{ $mou->moas()->count() }}</td>
                <td>{{ $mou->activities()->count() }}</td>
                <td>{{ $mou->started_at->format('j M Y') }}</td>
                <td>{{ $mou->ended_at->format('j M Y') }}</td>
                <td>
                    <form action="{{ route('mou.destroy', $mou) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('mou.edit', $mou) }}" class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/mou.list.js') }}" defer></script>
@endsection
