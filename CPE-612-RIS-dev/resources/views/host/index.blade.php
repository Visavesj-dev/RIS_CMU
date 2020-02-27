@extends('layouts.iframe')

@section('content')

<div class="container-fluid bg-white rounded pb-2 mb-4">
    
    <!-- head -->
    <div class="row pt-4">
        <div class="col-4">
            <h1>ผู้ต้อนรับ</h1>
        </div>
        <div class="col-8">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('host.create', $visitor) }}" class="btn btn-primary rounded">สร้าง</a>
            </div>
        </div>
    </div>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ชื่อ</th>
                <th scope="col">ตำแหน่ง</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hosts as $host)
            <tr class="clickable-row">
                <th scope="row">
                    {{ $host->name }}
                </th>
                <td>
                    {{ $host->position }}
                </td>
                <td>
                    <form action="{{ route('host.destroy', $host) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('host.edit', $host) }}" class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/host.iframe.js') }}" defer></script>
@endsection
