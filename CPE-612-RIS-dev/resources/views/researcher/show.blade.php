@extends('layouts.app')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">โครงการ #{{ request('project_name') }}</li>

            <li class="breadcrumb-item"><a href="{{ route('researcher.index') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}">ผู้ร่วมวิจัย</a></li>
            <li class="breadcrumb-item active" aria-current="page">#{{ $researcher->id }}</li>
        </ol>
    </nav>

    <!-- MoU -->
    <div class="container-fluid bg-white rounded pb-2 mb-4">


        <!-- head -->
        <div class="row pt-4">
            <div class="col-md-6">
                <h1>ผู้ร่วมวิจัย #{{ request('project_name') }}</h1>
            </div>
        </div>

        <!-- Detail -->
        <dl class="row">
            <dt class="col-md-3 col-lg-2">ผู้รับผิดชอบ</dt>
            <dd class="col-md-9">{{ $researcher->lecturer->fullname }}</dd>

            <dt class="col-md-3 col-lg-2">สังกัด</dt>
            <dd class="col-md-9">{{ $researcher->departments->name }}</dd>

            <dt class="col-md-3 col-lg-2">สัดส่วนงาน</dt>
            <dd class="col-md-9">{{ $researcher->work_ratio }}</dd>

            <dt class="col-md-3 col-lg-2">สัดส่วน OHC</dt>
            <dd class="col-md-9">{{ $researcher->OHC }}</dd>

            <dt class="col-md-3 col-lg-2">หมายเหตุ</dt>
            <dd class="col-md-9">{{ $researcher->note }}</dd>
        </dl>
        <!-- End of Detail -->

        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('researcher.edit', $researcher) }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of MoU -->

@endsection
