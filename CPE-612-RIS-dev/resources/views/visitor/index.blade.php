@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">วิเทศสัมพันธ์</li>        
        <li class="breadcrumb-item active" aria-current="page">อาคันตุกะ</li>
    </ol>
</nav>

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <div class="row pt-4">
        <div class="col-md-4">
            <h1>อาคันตุกะ{{ old('year') }}</h1>
        </div>
        <div class="col-md-8 ">
            <div class="d-flex flex-row-reverse">
                <a href="{{ route('visitor.create') }}" class="btn btn-primary rounded">สร้าง</a>
            </div>
        </div>
    </div>
    
    <form class="form-inline" method="GET" id="filter">
        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text">ปี ค.ศ.</span>
            </div>
            <select class="custom-select" id="year" name="year">
                <option value="">ไม่เลือก</option>
                @foreach ($years as $year)
                @if( Request::input('year') == $year['YEAR(visited_at)'])
                <option value="{{ $year['YEAR(visited_at)'] }} " selected>{{ $year['YEAR(visited_at)'] }}</option>
                @else
                <option value="{{ $year['YEAR(visited_at)'] }} ">{{ $year['YEAR(visited_at)'] }}</option>
                @endif
                
                @endforeach
            </select>
        </div>

        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text">ประเทศ</span>
            </div>
            <select class="custom-select" id="country" name="country_id">
                <option value="">ไม่เลือก</option>
                @foreach ($countries as $country)
                @if( Request::input('country_id') == $country->id)
                <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                @else
                <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endif
                
                @endforeach
            </select>
        </div>

        <div class="input-group input-group-sm mb-2 mr-sm-2">
            <input class="form-control" type="text" id="search" name="search" value="{{ Request::input('search') }}" placeholder="คำค้นหา">
            <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">ค้นหา</button>
            </div>
        </div>
        
    </form>

    <hr>

    <table class="table table-bordered table-striped" id="list">
        <thead class="bg-warning text-white">
            <tr>
                <th scope="col">มหาวิทยาลัย</th>
                <th scope="col">ประเทศ</th>
                <th scope="col">วันที่เข้าพบ</th>
                <th scope="col">จำนวน</th>
                <th scope="col">ชื่อ-สกุล อาคันตุกะ</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
            <tr class="clickable-row" data-href="{{ route('visitor.show', $visitor) }}">
                <th scope="row">
                    <a href="{{ route('visitor.show', $visitor) }}">{{ $visitor->university }}</a>
                </th>
                <td>{{ $visitor->country->name }}</td>
                <td>{{ $visitor->visited_at->format('j M Y') }}</td>
                <td>{{ $visitor->guests->count() }}</td>
                <td>
                    @foreach ($visitor->guests as $guest)
                        {{ $guest->name }}<br>
                    @endforeach
                </td>
                <td>
                    <form action="{{ route('visitor.destroy', $visitor) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('visitor.edit', $visitor) }}" class="btn btn-sm btn-warning btn-circle">
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
<script src="{{ asset('js/visitor.index.js') }}" defer></script>
@endsection
