@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/mou">โครงการวิจัย</a></li>
        <li class="breadcrumb-item active" aria-current="page">สรุปผลงานวิจัยภาควิชา</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>รายภาควิชา</h1>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-6">
            <form class="form-inline" method="GET" id="filter">
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            ปี ค.ศ.
                        </span>
                    </div>
                    <select class="custom-select" id="year" name="year">
                        <option value=""></option>
                    </select>
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            รูปแบบปีคำนวณ
                        </span>
                    </div>
                    <select class="custom-select" id="calculateType" name="calculateType">
                        <option value=""></option>
                    </select>
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            รูปแบบการแสดงผล
                        </span>
                    </div>
                    <select class="custom-select" id="displayType" name="displayType">
                        <option value=""></option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col col-md-6">
            <form class="form-inline" method="GET" id="filter">
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <input class="form-control" type="text" id="search" name="search" placeholder="คำค้นหา">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">ค้นหา</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-6">
            <form class="form-inline" method="GET" id="filter">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="">ไตรมาส 1
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="">ไตรมาส 2
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="">ไตรมาส 3
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="">ไตรมาส 4
                    </label>
                </div>
            </form>
        </div>

        <div class="col col-md-6">
            <form class="form-inline" method="GET" id="filter">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="">เสร็จสิ้น
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="">กำลังดำเนินการ
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="">วิจัย
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="">บริการวิชาการ
                    </label>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ภาควิชา</th>
                <th scope="col">จำนวนโครงการ</th>
                <th scope="col">งบประมาณ</th>
                <th scope="col">OHC</th>
            </tr>
        </thead>

        <tbody>

        </tbody>
    </table>

</div>

@endsection

@section('script')
<script src="{{ asset('js/research.index.js') }}" defer></script>
@endsection
