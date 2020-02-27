@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">การประชุมวิชาการ</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    
    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>ประชุมวิชาการ</h1>
        </div>
        <div class="col-md-8 ">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('meeting.create') }}" class="btn btn-primary rounded">สร้าง</a>
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-10">
            <form class="form-inline" method="GET" id="filter">
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ภาควิชา</span>
                    </div>
                    <select class="custom-select" id="department" name="department">
                        <option value="">ทั้งหมด</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ Request::input('department') == $department->id ? 'selected':'' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">สถานะ</span>
                    </div>
                    <select class="custom-select" name="status">
                        <option value="all" {{ Request::input('status') == 'all' ? 'selected':'' }} >ทั้งหมด</option>
                        <option value="ongoing" {{ Request::input('status') == 'ongoing' ? 'selected':'' }}>ดำเนินการอยู่</option>
                        <option value="concluded" {{ Request::input('status') == 'concluded' ? 'selected':'' }}>สรุปผลแล้ว</option>
                    </select>
                    
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <input class="form-control" type="text" id="search" name="search" placeholder="คำค้นหา">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">ค้นหา</button>
                    </div>
                </div>
            </form>
        </div>

        
    </div>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">หัวข้อการประชุม</th>
                <th scope="col">ภาควิชา</th>
                <th scope="col">วันที่เริ่มต้น</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">ประมาณการ</th>
                <th scope="col">รายรับจริง</th>
                <th scope="col">รายจ่ายจริง</th>
                @if (!Request::input('status'))
                <th scope="col">สถานะ</th>
                @endif
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($meetings as $meeting)
            <tr class="clickable-row" data-href="{{ route('meeting.show', $meeting) }}">
                <th scope="row">
                    {{ $meeting->id }}
                </th>
                <td>
                    {{ $meeting->title }}
                </td>
                <td>
                    {{ $meeting->department->name }}
                </td>
                <td>{{ $meeting->started_at->format('j M Y') }}</td>
                <td>{{ $meeting->ended_at->format('j M Y') }}</td>
                <td>
                    {{ number_format($meeting->budgets->sum('expected_amount'), 2) }}
                </td>
                <td>
                    {{ number_format($meeting->budgets->sum('actual_expenses'), 2) }}
                </td>
                <td>
                    {{ number_format($meeting->actual_expense, 2) }}
                </td>
                @if (!Request::input('status'))
                <td>
                    @if ($meeting->closed_at)
                    สรุปผลแล้ว
                    @else
                    ดำเนินการอยู่
                    @endif
                </td>
                @endif
                <td>
                    <form action="{{ route('meeting.destroy', $meeting) }}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf

                        <a href="{{ route('meeting.edit', $meeting) }}" class="btn btn-sm btn-warning btn-circle">
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
    <script src="{{ asset('js/meeting.index.js') }}" defer></script>
@endsection