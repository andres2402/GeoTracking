@extends('layouts.app', [
'class' => '',
'elementActive' => 'file manger'
])

@push('styles')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@section('content')
<div class="content">
    <div style="height: 800px;">
        <div id="fm"></div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endpush