@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('project.show',request('project_id')) }}">โครงการ #{{ request('project_name') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">งวดโครงการ </li>
    </ol>
</nav>


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

    div.scrollmenu {
  overflow: auto;
  white-space: nowrap;
}



</style>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    <!-- head -->

    <body>
        <nav>
            <div class="tab">
                <button class="tablinks" type="button"

                onclick="window.location.href = '{{ route('project.show',request('project_id')) }}';">ข้อมูลทั่วไป</button>
                <button class="tablinks" type="button" onclick="window.location.href = '{{ route('project-authorize.index') }}';">การมอบอำนาจ</button>
                <button class="tablinks" type="button"
                    onclick="window.location.href = '{{ route('researcher.index') }}?project_id={{ request('project_id') }}&project_name={{ request('project_name') }}';">ผู้ร่วมวิจัย</button>
                <button class="tablinks" type="button"
                    onclick="window.location.href = '';">งวดโครงการ</button>
                <button class="tablinks" type="button"
                    onclick="window.location.href = '';">ขยายเวลา</button>

            </div>
        </nav>

        <div class="row pt-4">
            <div class="col-md-6" >
                <h3> งวดโครงการ #{{ request('project_name') }}</h3>
            </div>
            <div class="col-md-6 ">
                <div class="d-flex flex-row-reverse">
                    <a href="{{route('project-installment.create')}}?project_id={{request('project_id')}}&project_name={{request('project_name')}}" class="btn btn-success rounded">+
                        เพิ่มงวดโครงการ</a>
                </div>
            </div>
        </div>
        <br>

        <div class="scrollmenu table">
        <table class="table-bordered table-striped overflow-auto" id="list">
            <thead class="bg-warning text-white table-overflow">
                <tr>
                    <th scope="col">งวดที่</th>
                    <th scope="col">วันที่สัญญา</th>
                    <th scope="col">วันที่รับจริง</th>
                    <th scope="col">งวดเงิน</th>
                    <th scope="col">นักวิจัย</th>
                    <th scope="col">OHC</th>
                    <!--@if (!Request::input('status'))
                <th scope="col">สถานะ</th>
                @endif-->
                <th scope="col">มช.</th>
                <th scope="col">คณะ</th>
                <th scope="col">ภาควิชา</th>
                <th scope="col">ธรรมเนียม</th>
                <th scope="col">เงินล่วงหน้า</th>
                <th scope="col">ประกันผลงาน</th>
                <th scope="col">อื่นๆ</th>
                <th scope="col">หมายเหตุ</th>
                <th scope="col">ตัวเลือก</th>
                <!--comment -->
            </tr>
        </thead>
        </div>



        <tbody>
            @foreach ($project_installment as $project_installments )
            @if($project_installments->project_id == request('project_id'))

            <tr >


                <td>
                    {{ $project_installments ->no }}
                </td>

                <td>
                    {{ $project_installments ->promised_date }}
                </td>

                <td>
                    {{ $project_installments ->receive_date }}
                </td>

                <td>
                    {{ $project_installments ->fund }}
                </td>

                <td>
                    {{ $project_installments ->researcher }}
                </td>

                <td>
                    {{ $project_installments ->ohc }}
                </td>

                <td>
                    {{ $project_installments ->university }}
                </td>

                <td>
                    {{ $project_installments ->faculty }}
                </td>

                <td>
                    {{ $project_installments ->department }}
                </td>
                <td>
                    {{ $project_installments ->fee }}
                </td>
                <td>
                    {{ $project_installments ->advance }}
                </td>
                <td>
                    {{ $project_installments ->insurance }}
                </td>
                <td>
                    {{ $project_installments ->others }}
                </td>
                <td>
                    {{ $project_installments ->notes }}
                </td>

                <td>
                    <form action="{{ route('project-installment.destroy', $project_installments) }}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf
                       
                        <a href="{{ route('project-installment.edit', $project_installments)}}?project_id={{request('project_id')}}&project_name={{request('project_name')}}" class="btn btn-sm btn-warning btn-circle">
                            <i class="fas fa-edit"></i>
                        </a>

                        <button type="button" class="btn btn-sm btn-danger btn-circle delete-button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>

            </tr>@endif
            @endforeach
        </tbody>

    </table>

</div>

@endsection

@section('script')
<script src="{{ asset('js/project.js') }}" defer></script>
@endsection
