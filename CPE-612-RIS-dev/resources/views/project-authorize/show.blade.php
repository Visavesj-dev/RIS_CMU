@extends('layouts.app')

@section('content')

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

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('project.index') }}">โครงการ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('project-authorize.index') }}">การขอมอบอำนาจ</a></li>
            <li class="breadcrumb-item active" aria-current="page">#{{ $projectAuthorize->id }}</li>
        </ol>
    </nav>

    <div class="tab">
            @foreach($projects as $project)
            @if($loop->first)

            <button class="tablinks" type="button" onclick="window.location.href = '{{ route('project.show',$project) }}';">ข้อมูลทั่วไป</button>
            <button class="tablinks" type="button" onclick="window.location.href = '';">การขอมอบอำนาจ</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('researcher.index') }}?project_id={{ $project->id }}&project_name={{ $project->project_name }}';">ผู้ร่วมวิจัย</button>
        <button class="tablinks" type="button" onclick="window.location.href = '{{ route('project-installment.index')}}?project_id={{ $project->id }}&project_name={{ $project->project_name }}';"> งวดโครงการ</button>

            @endif
            @endforeach

        <button class="tablinks" type="button" >ขยายเวลา</button>
        </div>


    <!-- projectAuthorize -->
    <div class="container-fluid bg-white rounded pb-2 mb-4">


        <!-- head -->
        <div class="row pt-4">
            <div class="col-md-6">
                <h1>การขอมอบอำนาจ #{{ $projectAuthorize->id }}</h1>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('project-authorize.index') }}" class="btn btn-primary mt-3 mb-4 mr-2">สรุปผลการมอบอำนาจ</a>
                </div>
            </div>
        </div>

        <!-- Detail -->
        <dl class="row">
            <dt class="col-md-3 col-lg-3">ชื่อโครงการ</dt>
            <dd class="col-md-9">
                <ul class="list-unstyled">
                    @foreach ($projectAuthorize->authorizes as $authorize)
                        @foreach ($projects as $project)
                            @if ($project->id === $authorize->project_id)
                                <li>{{ $project->project_name }}</li>
                            @endif
                        @endforeach
                    @endforeach
                </ul>
            </dd>

            <dt class="col-md-3 col-lg-3">วันเริ่มต้นข้อตกลง</dt>
            <dd class="col-md-9">
                <p>{{ $projectAuthorize->started_at->format('j M Y') }}</p>
            </dd>

            <dt class="col-md-3 col-lg-3">วันสิ้นสุดข้อตกลง</dt>
            <dd class="col-md-9">
                <p>{{ $projectAuthorize->ended_at->format('j M Y') }}</p>
            </dd>

            <dt class="col-md-3 col-lg-3">หัวข้อการมอบอำนาจที่เกี่ยวข้อง</dt>
            <dd class="col-md-9">
                <ul class="list-unstyled">
                    @foreach ($projectAuthorize->authorize_lists as $authorize_list)
                        <li>{{ $authorize_list->name }}</li>
                    @endforeach
                    @if ($projectAuthorize->otherAuthorize_list()->exists())
                        <li>{{ $projectAuthorize->otherAuthorize_list->name }}</li>
                    @endif
                </ul>
            </dd>

            <dt class="col-md-3 col-lg-3">พ.ร.บ. 60 จัดซื้อจัดจ้าง</dt>
            <dd class="col-md-9">{{ $projectAuthorize->act->name }}</dd>
        </dl>
        <!-- End of Detail -->

        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('project-authorize.edit', $projectAuthorize) }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of projectAuthorize -->



@endsection

@section('script')
    <script src="{{ asset('js/project-authorize.show.js') }}" defer></script>
@endsection
