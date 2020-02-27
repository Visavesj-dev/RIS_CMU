@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('document.index') }}">โหลดเอกสาร</a></li>
        <li class="breadcrumb-item active" aria-current="page">เพิ่มเอกสาร</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">เพิ่มเอกสาร</h1>

    <!-- Start Form -->
    <form action="{{ route('document.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">

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
                    <label for="university">ชื่อเอกสาร</label>
                    <input class="form-control" name="name" id="name" placeholder="ชื่อเอกสาร" value="{{ old('name') }}"
                        required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">รายละเอียด</label>
            <textarea rows="5" class="form-control" id="description" name="description"
                required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="type">ประเภท</label>
            <div class="container">
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="research" id="research" value="1"
                        {{ old('research') ? 'checked':''  }}>
                    <label class="form-check-label" for="research">วิจัย</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="service" id="service" value="1"
                        {{ old('service') ? 'checked':''  }}>
                    <label class="form-check-label" for="service">บริการวิชาการ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="foreign" id="foreign" value="1"
                        {{ old('foreign') ? 'checked':''  }}>
                    <label class="form-check-label" for="foreign">วิเทศสัมพันธ์</label>
                </div>
            </div>
        </div>

        <!-- Attachment -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col">
                    <label>แนบไฟล์</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="attachment" name="attachment" required>
                        <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Attachment -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('document.index') }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">สร้าง</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection
