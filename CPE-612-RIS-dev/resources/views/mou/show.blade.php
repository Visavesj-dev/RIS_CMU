@extends('layouts.app')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
            <li class="breadcrumb-item"><a href="{{ route('mou.index') }}">MoU</a></li>
            <li class="breadcrumb-item active" aria-current="page">#{{ $mou->id }}</li>
        </ol>
    </nav>

    <!-- MoU -->
    <div class="container-fluid bg-white rounded pb-2 mb-4">
        
        
        <!-- head -->
        <div class="row pt-4">
            <div class="col-md-6">
                <h1>MoU #{{ $mou->id }}</h1>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('mou.renew', $mou) }}" class="btn btn-primary mt-3 mb-4 mr-2">ต่ออายุ</a>
                </div>
            </div>
        </div>

        <!-- Detail -->
        <dl class="row">
            <dt class="col-md-3 col-lg-2">ประเภทข้อตกลง</dt>
            <dd class="col-md-9">{{ $mou->type->name }}</dd>

            <dt class="col-md-3 col-lg-2">หน่วยงานที่เข้าร่วม</dt>
            <dd class="col-md-9">
                <ul class="list-unstyled">
                    @foreach ($mou->partners as $partner)
                        <li>{{ $partner->name }} ประเทศ{{ $partner->country->name }}</li>
                    @endforeach
                </ul>
            </dd>

            <dt class="col-md-3 col-lg-2">ภาควิชาที่เกี่ยวข้อง</dt>
            <dd class="col-md-9">
                <ul class="list-unstyled">
                    @foreach ($mou->departments as $department)
                        <li>{{ $department->name }}</li>
                    @endforeach
                    @if ($mou->otherDepartment()->exists())
                        <li>{{ $mou->otherDepartment->name }}</li>
                    @endif
                </ul>
            </dd>

            <dt class="col-md-3 col-lg-2">รายละเอียดข้อตกลง</dt>
            <dd class="col-md-9">
                <p>{{ $mou->detail }}<p>
            </dd>

            <dt class="col-md-3 col-lg-2">วันลงนามข้อตกลง</dt>
            <dd class="col-md-9">
                <p>{{ $mou->made_agreement_at->format('j M Y') }}</p>
            </dd>

            <dt class="col-md-3 col-lg-2">วันเริ่มต้นข้อตกลง</dt>
            <dd class="col-md-9">
                <p>{{ $mou->started_at->format('j M Y') }}</p>
            </dd>

            <dt class="col-md-3 col-lg-2">วันสิ้นสุดข้อตกลง</dt>
            <dd class="col-md-9">
                <p>{{ $mou->ended_at->format('j M Y') }}</p>
            </dd>

            <dt class="col-md-3 col-lg-2">ไฟล์แนบ</dt>
            <dd class="col-md-9">
                @if ($mou->attachment()->exists())
                    <a href="{{ route('file.show', $mou->attachment) }}">{{ $mou->attachment->name }}</a>
                @else
                    ไม่มีไฟล์แนบ
                @endif
            </dd>
        </dl>
        <!-- End of Detail -->

        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('mou.edit', $mou) }}" class="btn btn-warning mt-3 mb-4">แก้ไข</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of MoU -->

    <div class="container-fluid bg-white rounded pb-2 mb-4">
        <div class="row pt-4 pb-2">
            <div class="col-md-8">
                <h3>กิจกรรมภายใต้ MoU#{{ $mou->id }} {{ $mou->partners->first()->name }}</h3>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('activity.create') }}?parent=mou&mou_id={{ $mou->id }}" class="btn btn-primary">สร้างกิจกรรม</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="activityTable">
            <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">ผู้รับผิดชอบ</th>
                <th scope="col">วันเริ่มต้น</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mou->activities as $activity)
                <tr class="clickable-row" data-href="{{ route('activity.show', $activity) }}">
                    <th scope="row">
                        {{ $activity->id }}
                    </th>
                    <td>
                        {{ $activity->title }}
                    </td>
                    <td>
                        {{ $activity->lecturer->fullname }}
                    </td>
                    <td>{{ $activity->started_at->format('j M Y') }}</td>
                    <td>{{ $activity->ended_at->format('j M Y') }}</td>
                    <td>
                        <form action="{{ route('activity.destroy', $activity) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <a href="{{ route('activity.edit', $activity) }}" class="btn btn-sm btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-danger btn-circle delete-button">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="container-fluid bg-white rounded pb-2 mb-4">

        <div class="row pt-4 pb-2">
            <div class="col-md-8">
                <h3>MoA ภายใต้ MoU#{{ $mou->id }} {{ $mou->partners->first()->name }}</h3>
            </div>
            <div class="col-md-4">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('moa.create') }}?mou_id={{ $mou->id }}" class="btn btn-primary">สร้าง MoA</a>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="moaTable">
            <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">ภาควิชา</th>
                <th scope="col">จำนวนกิจกรรม</th>
                <th scope="col">วันเริ่มต้น</th>
                <th scope="col">วันที่สิ้นสุด</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mou->moas as $moa)
                <tr class="clickable-row" data-href="{{ route('moa.show', $moa) }}">
                    <th scope="row">
                        {{ $moa->id }}
                    </th>
                    <td>
                        {{ $moa->title }}
                    </td>
                    <td>
                        @if ($moa->departments()->count() == 9)
                            <h5><span class="badge badge-pill badge-success">ALL</span></h5>
                        @else
                            @foreach ($moa->departments as $department)
                                <h5><span class="badge badge-pill badge-info">{{ $department->name }}</span></h5>
                            @endforeach
                        @endif

                        @if ($moa->otherDepartment)
                            <h5><span class="badge badge-pill badge-secondary">{{ $moa->otherDepartment->name }}</span>
                            </h5>
                        @endif
                    </td>
                    <td>{{ $moa->activities()->count() }}</td>
                    <td>{{ $moa->started_at->format('j M Y') }}</td>
                    <td>{{ $moa->ended_at->format('j M Y') }}</td>
                    <td>
                        <form action="{{ route('moa.destroy', $moa) }}" method="POST">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <a href="{{ route('moa.edit', $moa) }}" class="btn btn-sm btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-danger btn-circle delete-button">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/mou.show.js') }}" defer></script>
@endsection