@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">โครงการ</li>
    </ol>
</nav>


<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>โครงการ</h1>
        </div>
        <div class="col-md-8 ">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('project.create') }}" class="btn btn-success rounded">+ เพิ่มโครงการ</a>
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-10">
            <form class="form-inline" method="GET" id="filter">
                <i class="fa fa-filter"></i>
                    ตัวกรอง :
                    &nbsp
                </i>
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            ประเภท
                        </span>
                    </div>
                    <select class="custom-select" id="project_type" name="project_type">
                        <option value="">ทั้งหมด</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">สถานะ</span>
                    </div>
                    <select class="custom-select" id="status" name="status">
                        <option value="all" {{ Request::input('status') == "all" ? 'selected':'' }}>ทั้งหมด</option>
                        <option value="unexpired">ดำเนินการอยู่</option>
                        <option value="expired" {{ Request::input('status') == "expired" ? 'selected':'' }}>หมดอายุ</option>

                    </select>
                </div>
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">วันที่เริ่มสัญญา</span>
                    </div>
                    <input type="date" class="form-control" name="from" id="fromDate" value="{{ Request::input('from') }}" required>
                    <div class="input-group-prepend">
                        <span class="input-group-text">วันที่สิ้นสุดสัญญา</span>
                    </div>
                    <input type="date" class="form-control" name="to" id="toDate" value="{{ Request::input('to') }}" required>
                </div>
                <div class="input-group input-group-sm mb-2 mr-sm-2">
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
                <th scope="col">ชื่อโครงการ/กิจกรรม</th>
                <th scope="col">ประเภทโครงการ</th>
                <th scope="col">วันที่เริ่มสัญญา</th>
                <th scope="col">วันที่รับจริง</th>
                <th scope="col">นักวิจัย</th>
               
                <th scope="col">สถานะ</th>
                
                <th scope="col">การขอมอบอำนาจ</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>

        <tbody>
                @foreach ($projectss as $project)
                <tr class="clickable-row" data-href="{{ route('project.show', $project) }}">
                        <th scope="row">
                                {{ $project->id }}
                            </th>
                            <td>
                                {{ $project->project_name}}
                            </td>
                            <td>
                                {{ $project->project_type }}
                            </td>
                            <td>
                                {{ $project->started_at}}
                            </td>
                            <td>
                                    {{ $project->started_at}}
                            </td>
                            <td>
                                    {{ $project->head_project}}
                            </td>
                            <td>
                                    {{ $project->project_status}}
                            </td>
                            <td>
                            @foreach ($projectAuthorizes as $projectAuthorize)
                                @foreach ($projectAuthorize->authorizes as $authorize)
                                    <!-- <li>{{ $authorize->project_id }}</li> -->

                                        @if ($project->id == $authorize->project_id)

                                        <a href="{{ route('project-authorize.show', $projectAuthorize) }}">
                                        <h5><span class="badge badge-pill badge-success">มีการขอมอบอำนาจ ID: {{$projectAuthorize->id}}</span></h5></a>
                                        @endif

                                @endforeach
                            @endforeach
                            </td>
                            <td>
                                <form action="{{ route('project.destroy', $project) }}" method="POST">
                                    <input name="_method" type="hidden" value="DELETE">
                                    @csrf

                                    <a href="{{ route('project.edit', $project) }}"
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
