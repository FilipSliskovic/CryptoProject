@extends('layouts.layout')

@section('title') Favorites @endsection
@section('description') Displays your favorite crypto currencies @endsection
@section('keywords')test,teletrader,testapp,laravel,crypto @endsection

@section('content')

    <div class="container-fluid p-0 mb-5">
        <div class="container">
            <h1 class="display-1">Favorites</h1>

            @if(is_array($data))

                <input hidden id="symbols" value="{{json_encode($data)}}">
                <x-pairs-table />
                <script src="{{ asset('assets/js/Websocket.js') }}"></script>
{{--                {{dd($data)}}--}}
            @else
                <h2>{{$data}}</h2>
            @endif
        </div>
    </div>
@endsection
