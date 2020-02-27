@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">ผู้ใช้งานระบบ</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">
    
    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-10">
            <h1>ผู้ใช้งานระบบ</h1>
        </div>
        <div class="col-md-2">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    เพิ่ม
                </a>
            </div>
        </div>
    </div>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ชื่อ-สกุล</th>
                <th scope="col">cmu account</th>
                <th scope="col">admin</th>
                <th scope="col">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="clickable-row" data-href="{{ route('user.show', $user) }}">
                <th scope="row">
                    <a href="{{ route('user.show', $user) }}">
                        {{ $user->id }}
                    </a>
                </th>
                <td>
                    <a href="{{ route('user.show', $user) }}">
                    {{ $user->email }}
                    </a>
                </td>
                <td>
                    {{ $user->name ?? 'ยังไม่เคยเข้าสู่ระบบ' }}
                </td>
                <td>
                    @if ($user->is_admin)
                    <i class="fas fa-check"></i>
                    @else
                    <i class="fas fa-times-circle"></i>
                    @endif
                </td>
                <td>
                    <form action="{{ route('user.destroy', $user) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/user.index.js') }}" defer></script>
@endsection
