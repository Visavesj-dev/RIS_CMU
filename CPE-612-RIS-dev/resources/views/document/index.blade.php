@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">โหลดเอกสาร</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>โหลดเอกสาร</h1>
        </div>
        <div class="col-md-8 ">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('document.create') }}" class="btn btn-primary rounded">สร้าง</a>
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col col-md-10">
            <form class="form-inline" method="GET" id="filter">
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ประเภท</span>
                    </div>
                    <select class="custom-select" id="type" name="type">
                        <option value="">ไม่เลือก</option>
                        <option value="research">วิจัย</option>
                        <option value="service">บริการวิชาการ</option>
                        <option value="foreign">วิเทศสัมพันธ์</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <input class="form-control" type="text" id="search" name="search" value="{{ Request::input('search') }}" placeholder="คำค้นหา">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">ค้นหา</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">วันที่</th>
                <th scope="col">ชื่อเอกสาร</th>
                <th scope="col">รายละเอียด</th>
                <th scope="col">ประเภท</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
            <tr class="clickable-row" data-href="{{ route('document.show', $document) }}">
                <td>{{ $document->created_at->format('j M Y') }}</td>
                <th scope="row">
                    <a href="{{ route('document.show', $document) }}">{{ $document->name }}</a>
                </th>
                <td>{{ $document->description }}</td>
                <td>
                    {{ $document->research ? "วิจัย " : "" }}
                    {{ $document->service ? "บริการวิชาการ " : "" }}
                    {{ $document->foreign ? "วิเทศสัมพันธ์ " : "" }}    
                </td>           
                <td>
                    <form action="{{ route('document.destroy', $document) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('file.show', $document->attachment) }}" class="btn btn-sm btn-primary btn-circle">
                            <i class="fas fa-download"></i>
                        </a>

                        <a href="{{ route('document.edit', $document) }}" class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/document.index.js') }}" defer></script>
@endsection
