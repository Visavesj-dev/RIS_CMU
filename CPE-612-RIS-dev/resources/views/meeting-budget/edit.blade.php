@extends('layouts.iframe')

@section('content')

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไขผู้ต้นรับ</h1>

    <!-- Start Form -->
    <form action="{{ route('meeting-budget.update', $budget) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" name="name" value="{{ $budget->name }}" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ประมาณการ</label>
                    <input type="number" class="form-control" name="expect_amount" value="{{ $budget->expect_amount }}" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">รายรับจริง</label>
                    <input type="number" class="form-control" name="actual_amount" value="{{ $budget->actual_amount }}" required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="type">หมายเหตุ</label>
                    <input type="text" class="form-control" name="note" value="{{ $budget->note }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('meeting-budget.index', $budget->meeting_id) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection

@section('script')
<script src="{{ asset('js/meeting-budget.iframe.js') }}" defer></script>
@endsection