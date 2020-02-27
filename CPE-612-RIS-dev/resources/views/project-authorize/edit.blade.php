@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('project.index') }}">โครงการ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('project-authorize.index') }}">การขอมอบอำนาจ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('project-authorize.show', $projectAuthorize) }}">#{{ $projectAuthorize->id}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไขการขอมอบอำนาจ</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไขการขอมอบอำนาจ</h1>

    <!-- Start Form -->
    <form action="{{ route('project-authorize.update', $projectAuthorize) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input name="_method" type="hidden" value="PUT">

        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <li>กรุณาเลือกการขอมอบอำนาจ</li>
            </ul>
        </div>
        @endif

        <!-- authorizes -->
        <div class="form-group">
            <div id="authorize_list">

                @if ($projectAuthorize->authorizes()->exists())
                    @foreach ($projectAuthorize->authorizes as $authorize)
                        @foreach($projects as $project)
                            @if ($project->id == $authorize->project_id)
                            <h3 class="pt-4">โครงการ {{ $project->project_name }} #ID: {{ $project->id }}</h3>
                            <h5>วันเริ่มโครงการ {{ date('d-M-y', strtotime($projectAuthorize->started_at)) }} วันสิ้นสุดโครงการ {{ date('d-M-y', strtotime($projectAuthorize->ended_at)) }} </h5>
                            <input type="hidden" class="form-control col" name="authorizes[0][project_id]"
                                value="{{ $authorize->project_id }}" readonly>
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
        <!-- End of Authorizes -->

        <!-- Detail -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col">
                    <input type="hidden" class="form-control" id="started_at" name="started_at"
                        value="{{ $projectAuthorize->started_at }}" readonly>
                </div>
                <div class="col">
                    <input type="hidden" class="form-control" id="ended_at" name="ended_at"
                        value="{{ $projectAuthorize->ended_at }}" readonly>
                </div>
            </div>
        </div>
        <!-- End of Detail -->

        <!-- Checkbox -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="row justify-content-between">

                    <!-- Authorize_lists -->
                    <div class="form-group">
                        <div class="container">
                            @foreach ($authorize_lists as $authorize_list)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="authorize_lists[]"
                                    id="authorize_list-{{ $loop->index }}" value="{{ $authorize_list->id }}"
                                    {{ $projectAuthorize->authorize_lists->contains($authorize_list) ? 'checked':''  }}>
                                <label class="form-check-label"
                                    for="authorize_list-{{ $loop->index }}">{{ $authorize_list->name }}</label>
                            </div><br>
                            @endforeach

                            <input type="checkbox" id="myCheck" checked>
                            <label class="form-check-label" for="myCheck">อื่นๆ</label>

                                <div class="input-group mb-3 ml-2">
                                    <input type="text" class="form-control" name="authorize_list_custom"
                                        list="authorize_lists"
                                        value="{{ optional($projectAuthorize->otherAuthorize_list)->name }}" placeholder="โปรดระบุ">

                                </div>

                                <datalist id="authorize_lists">
                                    @foreach ($suggestedAuthorize_lists as $authorize_list)
                                    <option value="{{ $authorize_list->name }}"></option>
                                    @endforeach
                                </datalist>



                        </div>

                    </div>
                    <!-- End of Authorize_lists -->

                    <!-- Type act -->
                    <div class="col-4">

                        <div class="form-group">
                            <label for="act">พ.ร.บ. 60 จัดซื้อจัดจ้าง</label>
                            <select class="form-control" name="act" id="act" required>
                                @foreach ($acts as $act)
                                <option value="{{ $act->id }}"
                                    {{ $projectAuthorize->act->id == $act->id ? 'selected':'' }}>{{ $act->name
                            }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- End of Type act -->

                </div>
            </div>

        </div>
        <!-- End of Checkbox -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('project-authorize.show', $projectAuthorize) }}"
                        class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
