@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('project.show',request('project_id')) }}">โครงการ #{{ request('project_name') }}</a></li>
        <li class="breadcrumb-item">ผู้ร่วมวิจัย</li>
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

div.scrollmenu {
    overflow: auto;
    white-space: nowrap;
}
</style>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->

    <body>
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


            <!-- head -->
            {{-- <h3 class="pt-4">ผู้ร่วมวิจัย #{{request('project_name')}}</h3>

            <div class="row pt-4">
                <div class="col-md-12 ">
                    <div class="d-flex flex-row-reverse">
                        <a href="{{ route('researcher.create') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}" class="btn btn-primary rounded">เพิ่มผู้วิจัย</a>
                    </div>
                </div>
            </div> --}}

            <div class="row pt-4">
                    <div class="col-md-6" >
                        <h3> ผู้ร่วมวิจัย #{{request('project_name')}}</h3>
                    </div>
                    <div class="col-md-6 ">
                        <div class="d-flex flex-row-reverse">
                                <a href="{{ route('researcher.create') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}" class="btn btn-primary rounded">เพิ่มผู้วิจัย</a>
                        </div>
                    </div>
                </div>
                <br>

            <hr>

            <table class="table table-bordered table-striped" id="list-Researcher">
                <thead class="bg-warning text-white" align="center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ผู้วิจัย</th>
                        <th scope="col">สังกัด</th>
                        <th scope="col">สัดส่วนงาน</th>
                        <th scope="col">สัดส่วน OHC</th>
                        <th scope="col">หมายเหตุ</th>
                        <th scope="col">ตัวเลือก</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($researcher as $researchers)
                        @if ($researchers->project_id == request('project_id'))
                        <tr class="clickable-row"
                            data-href="{{ route('researcher.show', $researchers) }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}">
                            <th scope="row">
                                <center><a href="{{ route('researcher.show', $researchers) }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}">{{ $researchers->id }}</a>
                                </center>
                            </th>
                            <td>
                                {{ $researchers->lecturer->fullname }}
                            </td>
                            <td align="center">
                                {{ $researchers->departments->name }}
                            </td>
                            <td align="center">{{ $researchers->work_ratio }}</td>
                            <td align="center">{{ $researchers->OHC }}</td>
                            <td>{{ $researchers->note }}</td>
                            <td align="center">
                                <form action="{{ route('researcher.destroy', $researchers) }}" method="POST">
                                    <input name="_method" type="hidden" value="DELETE">
                                    @csrf

                                    <a href="{{ route('researcher.edit', $researchers) }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}"
                                        class="btn btn-sm btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-danger btn-circle delete-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>


        </tbody>
</div>



@endsection

@section('script')
<script src="{{ asset('js/project.js') }}" defer></script>
@endsection
