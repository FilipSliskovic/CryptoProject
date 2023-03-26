@extends('layouts.layout')

@section('title') Home @endsection
@section('description') Main page of the test app @endsection
@section('keywords')test,teletrader,testapp,laravel,crypto @endsection

@section('content')
{{--    {{dd($data)}}--}}
<input hidden id="symbols" value="{{json_encode($data)}}">
    <div class="container-fluid p-0 mb-5">
        <div class="container">
            <h1 class="display-1">Home</h1>
            <x-pairs-table />

            <script src="{{ asset('assets/js/Websocket.js') }}"></script>
        </div>
    </div>
@endsection
