@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('project.index') }}">โครงการ</a></li>
        <li class="breadcrumb-item active" aria-current="page">การขอมอบอำนาจ</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>การขอมอบอำนาจ</h1>
        </div>
        <div class="col-md-8 ">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('project-authorize.create') }}" class="btn btn-success rounded">+ เพิ่มโครงการ</a>
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-10">
            <form class="form-inline" method="GET" id="filter">
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
                <th scope="col">ชื่อโครงการ</th>
                <th scope="col">ประเภทโการขอมอบอำนาจ</th>
                <th scope="col">วันที่เริ่มสัญญา</th>
                <th scope="col">วันที่รับจริง</th>
                <th scope="col">พ.ร.บ. 60 จัดซื้อจัดจ้าง</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($projectAuthorizes as $projectAuthorize)
            <tr class="clickable-row" data-href="{{ route('project-authorize.show', $projectAuthorize) }}">
                <th scope="row">
                    <a href="{{ route('project-authorize.show', $projectAuthorize) }}">{{ $projectAuthorize->id }}</a>
                </th>
                <td>
                    <ul class="list-unstyled">
                    @foreach ($projectAuthorize->authorizes as $authorize)
                        @foreach ($projects as $project)
                            @if ($project->id === $authorize->project_id)
                                <li>{{ $project->project_name }}</li>
                            @endif
                        @endforeach
                    @endforeach
                    <ul class="list-unstyled">
                </td>
                <td>
                    @if ($projectAuthorize->authorize_lists()->count() == 5)
                    <h5><span class="badge badge-pill badge-success">ALL</span></h5>
                    @else
                        @foreach ($projectAuthorize->authorize_lists as $authorize_list)
                        <h5><span class="badge badge-pill badge-info">{{ $authorize_list->name }}</span></h5>
                        @endforeach
                    @endif

                    @if ($projectAuthorize->otherauthorize_list)
                    <h5><span class="badge badge-pill badge-secondary">{{ $projectAuthorize->otherAuthorize_list->name }}</span></h5>
                    @endif
                </td>

                <td>{{ $projectAuthorize->started_at->format('j M Y') }}</td>
                <td>{{ $projectAuthorize->ended_at->format('j M Y') }}</td>

                <td>
                <h5><span class="badge badge-pill badge-info">{{ $projectAuthorize->act->name }}</span></h5>
                </td>

                <td>
                    <form action="{{ route('project-authorize.destroy', $projectAuthorize) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('project-authorize.edit', $projectAuthorize) }}" class="btn btn-sm btn-warning btn-circle">
                            <i class="fas fa-edit"></i>
                        </a>
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
