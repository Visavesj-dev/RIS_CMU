@extends('layouts.iframe')

@section('content')

<div class="container-fluid bg-white rounded pb-2 mb-4">

    <!-- head -->
    <div class="row pt-4">
        <div class="col-4">
            <h1>แหล่งรายรับ</h1>
        </div>
        <div class="col-8">
            <div class="d-flex flex-row-reverse">
                @if (!$meeting->closed_at)
                <a href="{{ route('meeting-budget.create', $meeting) }}" class="btn btn-primary rounded">เพิ่ม</a>
                @endif
            </div>
        </div>
    </div>

    <hr>

    <table class="table table-bordered table-striped">
        <thead class="bg-warning text-white">
            <tr>    
                <th scope="col">แหล่งรายรับ</th>
                <th scope="col">ประมาณการ</th>
                <th scope="col">รายรับจริง</th>
                <th scope="col">หมายเหตุ</th>
                @if (!$meeting->closed_at)
                <th>ตัวเลือก</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($budgets as $budget)
            <tr>
                <td scope="row">
                    {{ $budget->name }}
                </td>
                <td>
                    {{ $budget->expect_amount }}
                </td>
                <td>
                    {{ $budget->actual_amount }}
                </td>
                <td>
                    {{ $budget->note }}
                </td>
                @if (!$meeting->closed_at)
                <td>
                    <form action="{{ route('meeting-budget.destroy', $budget) }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <a href="{{ route('meeting-budget.edit', $budget) }}" class="btn btn-sm btn-warning btn-circle">
                            <i class="fas fa-edit"></i>
                        </a>

                        <button type="button" class="btn btn-sm btn-danger btn-circle delete-button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
            <tr>
                <td scope="row">
                    <b>รวม</b>
                </td>
                <td>
                    <b>{{ number_format($budget->sum('expect_amount'), 2) }}</b>
                </td>
                <td>
                    <b>{{ number_format($budgets->sum('actual_amount'), 2) }}</b>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection

@section('script')
<script src="{{ asset('js/meeting-budget.iframe.js') }}" defer></script>
@endsection
