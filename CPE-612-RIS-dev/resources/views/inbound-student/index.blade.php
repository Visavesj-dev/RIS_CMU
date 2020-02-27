@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item active" aria-current="page">นักศึกษาต่างชาติ</li>        
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>นักศึกษาต่างชาติ</h1>
        </div>
        <div class="col-md-8 ">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('inbound-student.create') }}" class="btn btn-primary rounded">สร้าง</a>
            </div>
        </div>
    </div>

    <form class="form-inline" method="GET" id="filter">
        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text">ประเภท</span>
            </div>
            <select class="custom-select" id="type" name="type">
                <option value="">ไม่เลือก</option>
                @foreach ($studentTypes as $type)
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
                <span class="input-group-text">สถานะ</span>
            </div>
            <select class="custom-select" id="status" name="status">
                <option value="">ไม่เลือก</option>
                <option value="not-arrived" {{ Request::input('status') == "not-arrived" ? 'selected':'' }}>ยังไม่มา</option>
                <option value="not-departed" {{ Request::input('status') == "not-departed" ? 'selected':'' }}>ยังไม่กลับ</option>
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
                <th scope="col">ชื่อ</th>
                <th scope="col">อีเมล</th>
                <th scope="col">เบอร์โทรติดต่อ</th>
                <th scope="col">ประเทศ</th>
                <th scope="col">ประเภท</th>
                <th scope="col">ภาควิชา</th>
                <th scope="col">วันที่มา</th>
                <th scope="col">วันที่กลับ</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inboundStudents as $inboundStudent)
            <tr class="clickable-row" data-href="{{ route('inbound-student.show', $inboundStudent) }}">
                <th scope="row">
                    <a href="{{ route('inbound-student.show', $inboundStudent) }}">{{ $inboundStudent->full_name }}</a>
                </th>
                <td>{{ $inboundStudent->email }}</td>
                <td>{{ $inboundStudent->telephone }}</td>
                <td>{{ $inboundStudent->country->name }}</td>
                <td>{{ $inboundStudent->type->name }}</td>
                <td>{{ $inboundStudent->department->name }}</td>
                <td>{{ $inboundStudent->arrived_at->format('j M Y') }}</td>
                <td>{{ $inboundStudent->departed_at->format('j M Y') }}</td>
                <td>
                    <form action="{{ route('inbound-student.destroy', $inboundStudent) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('inbound-student.edit', $inboundStudent) }}" class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/inbound-student.index.js') }}" defer></script>
@endsection
