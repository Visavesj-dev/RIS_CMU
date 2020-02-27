@extends('layouts.iframe')

@section('content')

<div class="container-fluid bg-white rounded pb-2 mb-4">
    
    <!-- head -->
    <div class="row pt-4">
        <div class="col-4">
            <h1>อาคันตุกะ</h1>
        </div>
        <div class="col-8">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('guest.create', $visitor) }}" class="btn btn-primary rounded">สร้าง</a>
            </div>
        </div>
    </div>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ชื่อ</th>
                <th scope="col">ตำแหน่ง</th>
                <th scope="col">ความเชี่ยวชาญ</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guests as $guest)
            <tr class="clickable-row">
                <th scope="row">
                    {{ $guest->name }}
                </th>
                <td>
                    {{ $guest->position }}
                </td>
                <td>
                    {{ $guest->speciality }}
                </td>
                <td>
                    <form action="{{ route('guest.destroy', $guest) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('guest.edit', $guest) }}" class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/guest.iframe.js') }}" defer></script>
@endsection
