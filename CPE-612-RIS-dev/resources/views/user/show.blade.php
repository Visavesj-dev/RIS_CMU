@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user">ผู้ใช้งานระบบ</a></li>
        <li class="breadcrumb-item active" aria-current="page">#{{ $user->id }}</li>
    </ol>
</nav>

<!-- MoA -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">ผู้ใช้ระบบ #{{ $user->id }}</h1>

    <!-- Detail -->
    <dl class="row">
        <dt class="col-md-3 col-lg-2">อีเมล</dt>
        <dd class="col-md-9">
            {{ $user->email }}
        </dd>

        <dt class="col-md-3 col-lg-2">ชื่อ-สกุล</dt>
        <dd class="col-md-9">
            {{ $user->name ?? 'ยังไม่เคยเข้าสู่ระบบ' }}
        </dd>

        <dt class="col-md-3 col-lg-2">ภาควิชาที่เกี่ยวข้อง</dt>
        <dd class="col-md-9">
            <ul class="list-unstyled">
                @foreach ($user->departments()->orderBy('name')->get() as $department)
                <li>{{ $department->name }}</li>
                @endforeach
            </ul>
        </dd>

        <dt class="col-md-3 col-lg-2">สิทธิ์ผู้ดูแลระบบ</dt>
        <dd class="col-md-9">
            @if ($user->is_admin)
            <i class="fas fa-check"></i>
            @else
            <i class="fas fa-times-circle"></i>
            @endif
        </dd>
    </dl>
    <!-- End of Detail -->

    <div class="row">
        <div class="col-md-3">
            <div class="d-flex justify-content-end">
                <span>โครงการวิจัย</span>
            </div>
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-start">
                <div class="form-check mr-4">
                    <input class="form-check-input" type="checkbox" {{ $user->has_research_read ? 'checked':'' }} disabled>
                    <label class="form-check-label" for="{{ "has_research_read" }}">
                        อ่าน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" {{ $user->has_research_write ? 'checked':'' }} disabled>
                    <label class="form-check-label" for="{{ "has_research_write" }}">
                        เขียน
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="d-flex justify-content-end">
                <span>โครงการบริการวิชาการ</span>
            </div>
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-start">
                <div class="form-check mr-4">
                    <input class="form-check-input" type="checkbox" {{ $user->has_service_read ? 'checked':'' }} disabled>
                    <label class="form-check-label" for="{{ "has_service_read" }}">
                        อ่าน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" {{ $user->has_service_write ? 'checked':'' }} disabled>
                    <label class="form-check-label" for="{{ "has_service_write" }}">
                        เขียน
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="d-flex justify-content-end">
                <span>ประชุม</span>
            </div>
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-start">
                <div class="form-check mr-4">
                    <input class="form-check-input" type="checkbox" {{ $user->has_meeting_read ? 'checked':'' }} disabled>
                    <label class="form-check-label" for="{{ "has_meeting_read" }}">
                        อ่าน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" {{ $user->has_meeting_write ? 'checked':'' }} disabled>
                    <label class="form-check-label" for="{{ "has_meeting_write" }}">
                        เขียน
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="d-flex justify-content-end">
                <span>วิเทศสัมพันธ์</span>
            </div>
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-start">
                <div class="form-check mr-4">
                    <input class="form-check-input" type="checkbox" {{ $user->has_foreign_read ? 'checked':'' }} disabled>
                    <label class="form-check-label" for="{{ "has_foreign_read" }}">
                        อ่าน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" {{ $user->has_foreign_write ? 'checked':'' }} disabled>
                    <label class="form-check-label" for="{{ "has_foreign_write" }}">
                        เขียน
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('user.edit', $user) }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
            </div>
        </div>
    </div>

</div>
<!-- End of MoA -->

@endsection
