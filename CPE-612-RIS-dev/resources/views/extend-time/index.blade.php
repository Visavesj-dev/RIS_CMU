@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">ขยายเวลา</li>
    </ol>
</nav>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: Arial;
}

/* Style the tab */
.tab {
    overflow: hidden;
    border-bottom: 1px solid #ccc;
    background-color: white;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>


<nav>
    <div class="tab">
        <button class="tablinks" type="button"
            onclick="window.location.href = '{{ route('project.show', request('project_id')) }}';">ข้อมูลทั่วไป</button>
        <button class="tablinks" type="button"
            onclick="window.location.href = '{{ route('project-authorize.index') }}';">การมอบอำนาจ</button>
        <button class="tablinks" type="button"
            onclick="window.location.href = '{{ route('researcher.index') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}';">ผู้ร่วมวิจัย</button>
        <button class="tablinks" type="button"
            onclick="window.location.href = '{{ route('project-installment.index')}}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}';">งวดโครงการ</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('extend-time.index')}}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}';">ขยายเวลา</button>
    </div>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>การขยายเวลา #{{request('project_name')}}</h1>
        </div>
        <div class="col-md-8 ">
            <div class="d-flex flex-row-reverse">
            <a href="{{ route('extend-time.create') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}" class="btn btn-primary rounded">เพิ่มผู้วิจัย</a>
            </div>
        </div>
    </div>


    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ครั้งที่</th>
                <th scope="col">วันที่สิ้นสุดการขยายเวลา</th>
                <th scope="col">เหตุผล</th>
                <th scope="col">หมายเหตุ</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($extendTimes as $extendTime)
            <tr class="clickable-row" data-href="{{ route('extend-time.show', $extendTime) }}">
                <th scope="row">
                    {{ $extendTime->id }}
                </th>
                <td>
                    {{ $extendTime->date->format('j M Y') }}
                </td>
                <td>
                    {{ $extendTime->reason }}
                </td>
                <td>{{ $extendTime->note }}</td>
                <td>
                    <form action="{{ route('extend-time.destroy', $extendTime) }}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf

                        <a href="{{ route('extend-time.edit', $extendTime) }}"
                            class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/project.js') }}" defer></script>
@endsection