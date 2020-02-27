@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>
        <li class="breadcrumb-item"><a href="{{ route('mou.index') }}">MoU</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mou.show', $mou) }}">#{{ $mou->id}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">แก้ไข MoU</li>
    </ol>
</nav>

<!-- Adding Container -->
<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <h1 class="pt-4">แก้ไข MoU #{{ $mou->id }}</h1>

    <!-- Start Form -->
    <form action="{{ route('mou.update', $mou) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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

        <!-- Type -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">ประเภทข้อตกลง</label>
                    <select class="form-control" name="type" id="type" required>
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $mou->type->id == $type->id ? 'selected':'' }}>{{ $type->name
                            }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- End of Type -->

        <!-- Partners -->
        <div class="form-group">
            <label>หน่วยงานที่เกี่ยวข้อง</label>
            <div id="partner_list">
                @if (!$mou->partners()->exists())
                <div class="input-group">
                    <input type="text" class="form-control col" name="partners[0][name]" placeholder="ชื่อหน่วยงาน" list="partners" required>
                    <input type="text" class="form-control col-md-4" name="partners[0][country]" list="countries"
                        placeholder="ประเทศ" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-danger" type="button" onclick="deletePartner(this)">ลบ</button>
                    </div>
                </div>
                @else
                @foreach ($mou->partners as $partner)
                <div class="input-group">
                    <input type="text" class="form-control col" name="partners[{{ $loop->index }}][name]" placeholder="ชื่อหน่วยงาน"
                        value="{{ $partner['name'] }}" required>
                    <input type="text" class="form-control col-md-4" name="partners[{{ $loop->index }}][country]" list="countries"
                        placeholder="ประเทศ" value="{{ $partner->country->name }}" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-danger" type="button" onclick="deletePartner(this)">ลบ</button>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <datalist id="partners">
                @foreach ($partners as $partner)
                <option value="{{ $partner->name }}"></option>
                @endforeach
            </datalist>

            <datalist id="countries">
                @foreach ($countries as $country)
                <option value="{{ $country->name }}"></option>
                @endforeach
            </datalist>

            <button type="button" class="btn btn-success btn-icon-split btn-sm mt-2" onclick="addPartner()">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">เพิ่มหน่วยงาน</span>
            </button>

            
            <script>
                function deletePartner(event) {
                    let partner = event.parentNode.parentNode;
                    partner.parentNode.removeChild(partner);
                }

                function addPartner() {
                    let list = $('#partner_list');
                    let id = Math.random().toString(36).substr(2, 9);

                    list.append(`
                        <div class="input-group">
                            <input type="text" class="form-control col" name="partners[${id}][name]" placeholder="ชื่อหน่วยงาน" list="partners" required>
                            <input type="text" class="form-control col-md-4" name="partners[${id}][country]" list="countries"
                                placeholder="ประเทศ" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-danger" type="button" onclick="deletePartner(this)">ลบ</button>
                            </div>
                        </div>
                    `)
                }
            </script>
        </div>
        <!-- End of Partners -->

        <!-- Departments -->
        <div class="form-group">
            <label for="type">ภาควิชาที่เกี่ยวข้อง</label>
            <div class="container">
                @foreach ($departments as $department)
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="departments[]" id="department-{{ $loop->index }}"
                        value="{{ $department->id }}"
                        {{ $mou->departments->contains($department) ? 'checked':''  }}>
                    <label class="form-check-label" for="department-{{ $loop->index }}">{{ $department->name }}</label>
                </div>
                @endforeach
            </div>

            <div class="input-group mb-3 ml-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        อื่น ๆ
                    </div>
                </div>
                <input type="text" class="form-control" name="department_custom" list="departments" value="{{ optional($mou->otherDepartment)->name }}">
            </div>

            <datalist id="departments">
                @foreach ($suggestedDepartments as $department)
                <option value="{{ $department->name }}"></option>
                @endforeach
            </datalist>
        </div>
        <!-- End of Departments -->

        <!-- Detail -->
        <div class="form-group">
            <label for="detail">รายละเอียดข้อตกลง</label>
            <textarea class="form-control" id="detail" name="detail" required>{{ $mou->detail }}</textarea>
        </div>
        <!-- End of Detail -->

        <!-- Detail -->
        <div class="form-group">
            <div class="row mt-2">
                <div class="col">
                    <label for="made_agreement_at">วันลงนามข้อตกลง</label>
                    <input type="date" class="form-control" id="made_agreement_at" name="made_agreement_at" value="{{ $mou->made_agreement_at->format('Y-m-d') }}" required>
                </div>
                <div class="col">
                    <label for="started_at">วันเริ่มข้อตกลง</label>
                    <input type="date" class="form-control" id="started_at" name="started_at" value="{{ $mou->started_at->format('Y-m-d') }}" required>
                </div>
                <div class="col">
                    <label for="ended_at">วันสิ้นสุดข้อตกลง</label>
                    <input type="date" class="form-control" id="ended_at" name="ended_at" value="{{ $mou->ended_at->format('Y-m-d') }}" required>
                </div>
            </div>
        </div>
        <!-- End of Detail -->


        <!-- Attachment -->
        <div class="form-group">
            <label>ไฟล์แนบ</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="attachment" name="attachment">
                <label class="custom-file-label" for="attachment">เลือกไฟล์</label>
            </div>
            @if ($mou->attachment()->exists())
            <div class="mt-1">
                <a href="{{ route('file.show', $mou->attachment) }}">{{ $mou->attachment->name }}</a>

                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile()">ลบไฟล์</button>
            </div>
            @endif
        </div>
        <!-- End of Attachment -->

        <div class="row">
            <div class="mb-6 col-md-6 offset-md-6">
                <div class="d-flex flex-row-reverse">
                        <a href="{{ route('mou.show', $mou) }}" class="btn btn-outline-danger mt-3 mb-4 ml-2">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">บันทึก</button>
                </div>
            </div>
        </div>
    </form>

    @if ($mou->attachment()->exists())
    <script>
        function removeFile() {
            if (confirm("ต้องการลบไฟล์นี้ใช่หรอไม่")) {
                $('#removeAttachment').submit();
            }
        }
    </script>
    <form action="{{ route('file.destroy', $mou->attachment) }}" method="POST" id="removeAttachment">
        <input name="_method" type="hidden" value="DELETE">
        @csrf
    </form>
    @endif
</div>

@endsection
