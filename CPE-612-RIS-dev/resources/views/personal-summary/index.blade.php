@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">สรุปบริการวิชาการ</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>รายคน</h1>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-10">
                <form class="form-inline" method="GET" id="filter">
                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ปี พ.ศ.</span>
                        </div>
                        <select class="custom-select" id="year" name="year">
                            <option value="">ไม่เลือก</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">รูปแบบปีคำนวณ</span>
                        </div>
                        <select class="custom-select" id="calculation-format" name="calculation-format">
                            <option value="">ไม่เลือก</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">รูปแบบการแสดงผล</span>
                        </div>
                        <select class="custom-select" id="showing-format" name="showing-format">
                            <option value="">ไม่เลือก</option>
                        </select>
                    </div>              
                </form>
        </div>
        <div class="col col-md-2">
            <div class="input-group input-group-sm mb-2 mr-sm-2">
                <input class="form-control" type="text" id="search" name="search" value="คำค้นหา" placeholder="คำค้นหา">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">รายชื่อ</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-9">
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="">ไตรมาศ 1
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="">ไตรมาศ 2
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="">ไตรมาศ 3
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="">ไตรมาศ 4
                </label>
            </div>
        </div>

        <div class="col col-md-3">
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
        </div>
    </div>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">หัวหน้าโครงการ</th>
                <th scope="col">ภาควิชา</th>
                <th scope="col">จำนวณโครงการ</th>
                <th scope="col">งบประมาณ</th>
                <th scope="col">OHC</th>
            </tr>
        </thead>

        <tbody>
        </tbody>
    </table>


</div>
@endsection