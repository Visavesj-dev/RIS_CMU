@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('project.index') }}">โครงการ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('project-authorize.index') }}">การขอมอบอำนาจ</a></li>
        <li class="breadcrumb-item active" aria-current="page">สร้าง</li>
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
            @foreach($projects as $project)
            @if($loop->first)

            <button class="tablinks" type="button" onclick="window.location.href = '{{ route('project.show',$project) }}';">ข้อมูลทั่วไป</button>
            <button class="tablinks" type="button" onclick="window.location.href = '{{ route('project-authorize.create') }}';">การขอมอบอำนาจ</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('researcher.index') }}?project_id={{ $project->id }}&project_name={{ $project->project_name }}';">ผู้ร่วมวิจัย</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('project-installment.index')}}?project_id={{ $project->id }}&project_name={{ $project->project_name }}';"> งวดโครงการ</button>

            @endif
            @endforeach

        <button class="tablinks" type="button" >ขยายเวลา</button>
        </div>


            <!-- Adding Container -->
            <div class="container-fluid bg-white rounded pb-2 mb-4" >

                <!-- head -->
                <h1 class="pt-4">สร้างการขอมอบอำนาจ</h1>

                <!-- Start Form -->
                <form action="/project-authorize" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            <li>กรุณาเลือกการขอมอบอำนาจ</li>
                        </ul>
                    </div>
                    @endif

                    @foreach($projects as $project)
                        @if($loop->first)
                            @forelse($authorizes as $authorize)
                            @empty
                                <!-- {{$found = true}} -->
                            @endforelse
                            @foreach ($authorizes as $authorize)
                                @if ($project->id != $authorize->project_id)
                                    <!-- {{$found = true}} -->
                                @else
                                    <!-- {{$found = false}} -->
                                    @break
                                @endif
                            @endforeach
                            @break
                        @endif
                    @endforeach

                    @if($found == true)
                        <!-- authorizes -->
                        <div class="form-group">
                            <div id="authorize_list">

                            @foreach ($projects as $project)
                                @if($loop->first)
                                    <h3 class="pt-4">โครงการ {{ $project->project_name }} #ID: {{ $project->id }}</h3>
                                    <h5>วันเริ่มโครงการ {{ date('d-M-y', strtotime($project->started_at)) }} วันสิ้นสุดโครงการ {{ date('d-M-y', strtotime($project->ended_at)) }} </h5>
                                    <input type="hidden" class="form-control col" name="authorizes[0][project_id]" value="{{ $project->id }}" readonly>
                                @endif
                            @endforeach
                            </div>
                        </div>
                        <!-- End of Authorizes -->

                        <!-- Detail -->
                        <div class="form-group">
                            <div class="row mt-2">
                            @foreach ($projects as $project)
                                @if($loop->first)
                                <div class="col">
                                    <input type="hidden" class="form-control" id="started_at" name="started_at"
                                        value="{{ $project->started_at }}" readonly>
                                </div>
                                <div class="col">
                                    <input type="hidden" class="form-control" id="ended_at" name="ended_at"
                                        value="{{ $project->ended_at }}" readonly>
                                </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                        <!-- End of Detail -->

                        <!-- Checkbox -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="row justify-content-between">

                                    <!-- Authorize_lists -->
                                    <div class="form-group">
                                        <div class="container">
                                            @foreach ($authorize_lists as $authorize_list)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="authorize_lists[]"
                                                    id="authorize_list-{{ $loop->index }}" value="{{ $authorize_list->id }}"
                                                    {{ collect(old('authorize_lists'))->contains($authorize_list->id) ? 'checked':''  }}>
                                                <label class="form-check-label"
                                                    for="authorize_list-{{ $loop->index }}">{{ $authorize_list->name }}</label>
                                            </div><br>
                                            @endforeach

                                            <input type="checkbox" id="myCheck" onclick="myFunction()">
                                            <label class="form-check-label" for="myCheck">อื่นๆ</label>
                                            <div id="text" style="display:none">
                                                <div class="input-group mb-3 ml-2">
                                                    <input type="text" class="form-control" name="authorize_list_custom"
                                                        list="authorize_lists" value="{{ old('authorize_list_custom') }}"
                                                        placeholder="โปรดระบุ">
                                                </div>

                                                <datalist id="authorize_lists">
                                                    @foreach ($suggestedAuthorize_lists as $authorize_list)
                                                    <option value="{{ $authorize_list->name }}"></option>
                                                    @endforeach
                                                </datalist>

                                            </div>

                                            <script>
                                                function myFunction() {
                                                    // Get the checkbox
                                                    var checkBox = document.getElementById("myCheck");
                                                    // Get the output text
                                                    var text = document.getElementById("text");

                                                    // If the checkbox is checked, display the output text
                                                    if (checkBox.checked == true) {
                                                        text.style.display = "block";
                                                    } else {
                                                        text.style.display = "none";
                                                    }
                                                }
                                            </script>

                                        </div>

                                    </div>
                                    <!-- End of Authorize_lists -->

                                    <!-- Type act -->
                                    <div class="col-4">

                                        <div class="form-group">
                                            <label for="act">พ.ร.บ. 60 จัดซื้อจัดจ้าง</label>
                                            <select class="form-control col" name="act" id="act" placeholder="โปรดระบุ" required>
                                                @foreach ($acts as $act)
                                                <option value="{{ $act->id }}"
                                                    {{ old('act') == $act->id ? 'selected':'' }}>{{ $act->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End of Type act -->

                                </div>
                            </div>

                        </div>
                        <!-- End of Checkbox -->

                        <div class="row">
                            <div class="mb-6 col-md-6 offset-md-6">
                                <div class="d-flex flex-row-reverse">
                                    <a href="{{ route('project-authorize.index') }}"
                                        class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                                    <button type="submit" class="btn btn-primary mt-3 mb-4">สร้าง</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <h3><span class="badge badge-pill badge badge-warning">กรุณากรอกข้อมูลทั่วไป</span></h3></a>
                    @endif

                </form>
            </div>

    </body>

</html>

@endsection
