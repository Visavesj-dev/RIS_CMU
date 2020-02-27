@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">โครงการ #{{$projectss -> project_name }}</li>
    </ol>
</nav>
<!DOCTYPE html>
<html>

<head>
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
</head>

<body>

    <div class="tab">
            <button class="tablinks" type="button"

            onclick="window.location.href = '{{ route('project.show', $projectss) }}';">ข้อมูลทั่วไป</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('project-authorize.index') }}';">การมอบอำนาจ</button>


        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('researcher.index') }}?project_id={{ $projectss->id }}&project_name={{ $projectss->project_name }}';">ผู้ร่วมวิจัย</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('project-installment.index')}}?project_id={{ $projectss->id }}&project_name={{ $projectss->project_name }}';"> งวดโครงการ</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('extend-time.index')}}?project_id={{ $projectss->id }}&project_name={{ $projectss->project_name }}';">ขยายเวลา</button>
    </div>



    <!-- Adding Container -->



    <div class="container-fluid bg-white rounded pb-2 mb-4">
        <div style="margin-left: 50px">
            <div class="row pt-4">
                <div class="col-md-6">
                        <h3>โครงการ #{{$projectss -> project_name }}  </h3>
                </div>
                <div class="col-md-6 ">
                    <div class="d-flex flex-row-reverse">
                        <a  href="{{ route('project.edit', $projectss ) }}" class="btn btn-success rounded">+ แก้ไข</a>
                        <!-- ปุ่มแก้ไข ต้องส่ง id มาที่หน้า edit -->
                    </div>
                </div>
            </div>
            <!-- Start Form -->
            <br>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ประเภทโครงการ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> project_type}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ชื่อโครงการ/กิจกรรม</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> project_name }}
                                </font>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ประเภทยุทธศาสตร์</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> strategy_type}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>รหัส CMU SIS</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> cmu_mis_code}}
                                </font>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ประเภททุน</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> fund_type}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ชื่อแหล่งทุน</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> fund_source}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>วันที่เริ่มต้นโครงการ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> started_at}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>วันสิ้นสุดโครงการ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> ended_at}}
                                </font>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ชื่อหน่วยงานออกใบเสร็จ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> fund_giver_name}}
                                </font>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ที่อยู่หน่วยงานออกใบเสร็จ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> fund_giver_address}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>รายการใบเสร็จ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> receipt_list}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                                <div class="form-group">
                                    <label>จำนวณงวด</label>
                                    <br>
                                    <font size="3" color="black" style="margin-left: 24px">
                                    {{$count}}
                                    </font>
                                </div>
                            </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>งบประมาณทั้งโครงการ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> all_money_project}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ค่า OHC ทั้งหมด</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> all_OHC}}
                                </font>
                            </div>
                        </div>


                        <div class="col-md-3">
                                <div class="form-group">
                                    <label>ร้อยละ OHC</label>
                                    <br>
                                    <font size="3" color="black" style="margin-left: 24px">{{$projectss -> percent_OHC}}
                                    </font>
                                </div>
                            </div>




                        <div class="col-md-3">
                            <div class="form-group">
                                <label>สถานะโครงการ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> project_status}}
                                </font>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>หัวหน้าโครงการ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> head_project}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ภาควิชาที่สังกัด</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> department_subject}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>จำนวณผู้วิจัย</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">
                                {{$count_lecturer}}
                                </font>
                            </div>
                        </div>


                    </div>

                    <!-- แก้เพิ่มเติมเริ่มตรงนี้ -->
                    <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ประเภทการเเบ่ง OHC</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> OHC_type}}
                                </font>
                            </div>
                        </div>

                    </div>

                    <div class="row">


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>มช</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> cmu}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>คณะวิศวกรรมศาสตร์</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> faculty}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ภาควิชา</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> department}}
                                </font>
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>เหตุผล</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> reason}}</font>

                            </div>
                        </div>

                    </div>

                    <br><br>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>งวดเงินปัจจุบัน</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">
                                        {{$query_highest}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>วันที่ได้รับเงินงวด</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">
                                        {{$query_date}}
                                </font>
                            </div>
                        </div>


                    </div>

                    <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ขยายเวลาครั้งที่</label>
                                    <br>
                                    <font size="3" color="black" style="margin-left: 24px">
                                    </font>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่สิ้นสุดการขยายเวลา</label>
                                    <br>
                                    <font size="3" color="black" style="margin-left: 24px">
                                    </font>
                                </div>
                            </div>

                        </div>


                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>วันที่ปิดโครงการ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">
                                </font>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ผลลัพธ์โครงการ</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> result_project}}
                                </font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>รายละเอียดผลลัพธ์</label>
                                <br>
                                <font size="3" color="black" style="margin-left: 24px">{{$projectss -> result_detail}}
                                </font>
                            </div>
                        </div>
                    </div>

                    <!-- สิ้นสุดแก้ไข้ -->



                </div>

            </div>

            </form>
        </div>
    </div>
    @endsection

    @section('script')
    <script src="{{ asset('js/research.js') }}" defer></script>

    @endsection
