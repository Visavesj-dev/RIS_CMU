@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

<div class="row pb-4">
    <div class="col-md-6">
        <div class="embed-responsive" id="child-a-container">
            <iframe class="embed-responsive-item" src="{{ url('childa') }}" allowfullscreen></iframe>
        </div>
    </div>
    <div class="col-md-6">
        <div class="embed-responsive" id="child-b-container">
            <iframe class="embed-responsive-item" src="{{ url('childb') }}" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/dashboard.parent.js') }}" defer></script>
@endsection