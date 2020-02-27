@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: Arial;
}

/* Style the tab */
.tab {
    overflow: hidden;
    border-bottom: 1px solid #ccc;
    background-color: white;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>


<nav>
    <div class="tab">
        <button class="tablinks" type="button"
            onclick="window.location.href = '{{ route('project.show', request('project_id')) }}';">ข้อมูลทั่วไป</button>
        <button class="tablinks" type="button"
            onclick="window.location.href = '{{ route('project-authorize.index') }}';">การมอบอำนาจ</button>
        <button class="tablinks" type="button"
            onclick="window.location.href = '{{ route('researcher.index') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}';">ผู้ร่วมวิจัย</button>
        <button class="tablinks" type="button"
            onclick="window.location.href = '{{ route('project-installment.index')}}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}';">งวดโครงการ</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('extend-time.index')}}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}';">ขยายเวลา</button>
    </div>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <h1 class="pt-4">แก้ไขการขยายเวลา #{{request('project_name')}}</h1>
    @if(count($errors) > 0)
    <!-- กรณีผิดพลาด -->
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    <br>
    @endif
    @if(\Session::has('success'))
    <!-- กรณีสำเร็จ -->
    <div class="alert alert-success">
        <h5>{{ \Session::get('success') }}</h5>
    </div>
    <br>
    @endif

    <!-- Start Form -->
    <form action="{{ route('extend-time.update', $extendTime) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <input name="_method" type="hidden" value="PUT">

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

        <hr>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>วันที่สิ้นสุดการขยายเวลา</label>
                            <input type="date" name="date" value="{{$extendTime->date}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label>เหตุผล</label>
                            <input type="text" name="reason" value="{{$extendTime->reason}}" class="form-control"
                                required>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>หมายเหตุ</label>
                            <textarea type="text" name="note" class="form-control">{{$extendTime->note}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('extend-time.index') }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>

            </div>

        </div>

    </form>
</div>
@endsection

@section('script')
<script src="{{ asset('js/research.js') }}" defer></script>
@endsection