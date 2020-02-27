@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('document.index') }}">โหลดเอกสาร</a></li>
        <li class="breadcrumb-item">{{ $document->name }}</li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไข</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">โหลดเอกสาร</h1>

    <!-- Start Form -->
    <form action="{{ route('document.update', $document) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">

        @csrf
        @method('PUT')

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
                    <input class="form-control" name="name" id="name" placeholder="ชื่อเอกสาร"
                        value="{{ $document->name }}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">รายละเอียด</label>
            <textarea rows="5" class="form-control" id="description" name="description"
                required>{{ $document->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="type">ประเภท</label>
            <div class="container">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="research" value="0">
                    <input type="checkbox" class="form-check-input" name="research" id="research" value="1"
                        {{ $document->research ? 'checked':''  }}>
                    <label class="form-check-label" for="research">วิจัย</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="hidden" name="service" value="0">
                    <input type="checkbox" class="form-check-input" name="service" id="service" value="1"
                        {{ $document->service ? 'checked':''  }}>
                    <label class="form-check-label" for="service">บริการวิชาการ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="hidden" name="foreign" value="0">
                    <input type="checkbox" class="form-check-input" name="foreign" id="foreign" value="1"
                        {{ $document->foreign ? 'checked':''  }}>
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
                    <input type="file" class="custom-file-input" id="attachment" name="attachment">
                        <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
                    </div>
                </div>
            </div>
            @if ($document->attachment)
            <div class="row mt-1">
                <div class="col">
                    <a href="{{ route('file.show', $document->attachment) }}">{{ $document->attachment->name }}</a>
                </div>
            </div>
            @endif
        </div>
        <!-- End of Attachment -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('document.index') }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection
