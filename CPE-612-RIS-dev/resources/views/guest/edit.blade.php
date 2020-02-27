@extends('layouts.iframe')

@section('content')

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไขอาคันตุกะ</h1>

    <!-- Start Form -->
    <form action="{{ route('guest.update', $guest) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                    <label for="type">ชื่อ</label>
                    <input type="text" class="form-control" name="name" value="{{ $guest->name }}" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ตำแหน่ง</label>
                    <input type="text" class="form-control" name="position" value="{{ $guest->position }}" required>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ความเชี่ยวชาญ</label>
                    <input type="text" class="form-control" name="speciality" value="{{ $guest->speciality }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('guest.index', $guest->visitor_id) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection

@section('script')
<script src="{{ asset('js/guest.iframe.js') }}" defer></script>
@endsection