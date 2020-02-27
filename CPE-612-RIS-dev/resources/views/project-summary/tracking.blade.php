@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/mou">โครงการวิจัย</a></li>
        <li class="breadcrumb-item active" aria-current="page">ติดตามผลงานวิจัย</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    <div class="row pt-4">
        <div class="col-md-12">
            <h1>ติดตามโครงงานการวิจัย/โครงการบริการวิชาการ</h1>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-6">
            <form class="form-inline" method="GET" id="filter">
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            ประเภทการติดตาม(ล่าช้า)
                        </span>
                    </div>
                    <select class="custom-select" id="trackingType" name="trackingType">
                        <option value=""></option>
                    </select>
                </div>
            </form>
        </div>
        
        <div class="col col-md-6">
            <form class="form-inline" method="GET" id="filter">
                กดส่งอีเมล์ &nbsp <i class="fa fa-file-excel"></i> &nbsp รายชื่อ &nbsp
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
                <th scope="col">
                    <input type="checkbox" id="check-all" onclick="checkAll(this)">
                </th>
                <th scope="col">หัวหน้าโครงการ</th>
                <th scope="col">ชื่อโครงการ</th>
                <th scope="col">งบประมาณ</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">เงินงวด</th>
                <th scope="col">วันที่รับเงินงวด</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                    <td scope="col">
                            <input type="checkbox" id="row-checkbox">
                        </td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
            </tr>
            <tr>
                    <td scope="col">
                            <input type="checkbox" id="row-checkbox">
                        </td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
                        <td scope="col">ทดสอบ</td>
            </tr>
                
        </tbody>
    </table>

</div>

@endsection

@section('script')
<script>
    function checkAll($element){
        $("input[id='row-checkbox']").each(function(){
            this.checked = $element.checked;
        });
    }
</script>
<script src="{{ asset('js/research.index.js') }}" defer></script>
@endsection
