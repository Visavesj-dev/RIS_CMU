@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/document">เอกสาร</a></li>
        <li class="breadcrumb-item active" aria-current="page">สร้างเอกสาร</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไขผู้ใช้งาน</h1>

    <!-- Start Form -->
    <form action="{{ route('user.update', $user) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">

        @method('PUT')
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email">CMU Account (email)</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" pattern=".+@.*cmu\.ac\.th" placeholder="prasin.o@cmu.ac.th" requried>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>ระบบ</label>
                    <div class="form-check">
                        <input type="hidden" name="is_admin" value="0">
                        <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" value="1" {{ $user->is_admin ? 'checked':'' }}>
                        <label class="form-check-label" for="is_admin">สิทธิ์ผู้ดูแลระบบ</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="type">ภาควิชาที่เกี่ยวข้อง</label>
                    <div class="container">
                        @foreach ($departments as $department)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="departments[]" id="department-{{ $loop->index }}"
                                value="{{ $department->id }}"
                                {{ $user->departments->contains($department->id) ? 'checked':'' }}>
                            <label class="form-check-label" for="department-{{ $loop->index }}">{{ $department->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="d-flex justify-content-end">
                    <span>โครงการวิจัย</span>
                </div>
            </div>
            <div class="col-md-9">
                <div class="d-flex justify-content-start">
                    <div class="form-check mr-4">
                        <input type="hidden" name="has_research_read"value="0">
                        <input class="form-check-input" type="checkbox" value="1" id="has_research_read" name="has_research_read" {{ $user->has_research_read ? 'checked':'' }}>
                        <label class="form-check-label" for="has_research_read">
                            อ่าน
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="has_research_write" value="0">
                        <input class="form-check-input" type="checkbox" value="1" id="has_research_write" name="has_research_write" {{ $user->has_research_write ? 'checked':'' }}>
                        <label class="form-check-label" for="has_research_write">
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
                        <input type="hidden" name="has_service_read"value="0">
                        <input class="form-check-input" type="checkbox" value="1" id="has_service_read" name="has_service_read" {{ $user->has_service_read ? 'checked':'' }}>
                        <label class="form-check-label" for="has_service_read">
                            อ่าน
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="has_service_write" value="0">
                        <input class="form-check-input" type="checkbox" value="1" id="has_service_write" name="has_service_write" {{ $user->has_service_write ? 'checked':'' }}>
                        <label class="form-check-label" for="has_service_write">
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
                        <input type="hidden" name="has_meeting_read"value="0">
                        <input class="form-check-input" type="checkbox" value="1" id="has_meeting_read" name="has_meeting_read" {{ $user->has_meeting_read ? 'checked':'' }}>
                        <label class="form-check-label" for="has_meeting_read">
                            อ่าน
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="has_meeting_write" value="0">
                        <input class="form-check-input" type="checkbox" value="1" id="has_meeting_write" name="has_meeting_write" {{ $user->has_meeting_write ? 'checked':'' }}>
                        <label class="form-check-label" for="has_meeting_write">
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
                        <input type="hidden" name="has_foreign_read"value="0">
                        <input class="form-check-input" type="checkbox" value="1" id="has_foreign_read" name="has_foreign_read" {{ $user->has_foreign_read ? 'checked':'' }}>
                        <label class="form-check-label" for="has_foreign_read">
                            อ่าน
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="has_foreign_write" value="0">
                        <input class="form-check-input" type="checkbox" value="1" id="has_foreign_write" name="has_foreign_write" {{ $user->has_foreign_write ? 'checked':'' }}>
                        <label class="form-check-label" for="has_foreign_write">
                            เขียน
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('user.show', $user) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection

@section('script')
<script src="{{ asset('js/document.create.js') }}" defer></script>
@endsection