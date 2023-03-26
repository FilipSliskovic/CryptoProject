@extends('layouts.layout')

@section('title') Details @endsection
@section('description') Displays single currency @endsection
@section('keywords')test,teletrader,testapp,laravel,crypto @endsection

@section('content')
    <div class="container-fluid p-0 mb-5">
        <div class="container">
            <h1 class="display-1">Details</h1>
{{--            <p>{dd($data)}}{</p>--}}

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success-msg'))
                <div class="alert alert-success">
                    <p>{{session('success-msg')}}</p>
                </div>
            @endif


            <div>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Symbol</th>
                        <th scope="col">Last price</th>
                        <th scope="col">Daily high</th>
                        <th scope="col">Daily low</th>
                    </tr>
                    </thead>
                    <tbody>
                    <td>{{$symbol}}</td>
                    <td>{{$data->last_price}}</td>
                    <td>{{$data->high}}</td>
                    <td>{{$data->low}}</td>
                    </tbody>
                </table>
            </div>
            <div>
{{--                --}}
{{--                    @if(session()->get("user")->favorite &&  $symbol.in_array(session()->get("user")->favorite))--}}
{{--                        <button onclick="" class="btn btn-danger">Remove from fav</button>--}}
{{--                    @else--}}
{{--                        <button onclick="AddToFav({{$symbol}})" class="btn btn-primary">Add to fav</button>--}}
{{--                    @endif--}}
{{--                @if(session()->get("Favorites"))--}}
{{--                    {{dd(session()->get("Favorites"))}}--}}
{{--                @endif--}}
                @if(in_array($symbol,session('Favorites', [])))
                    <form method="POST" action="{{ route('Favorite-destroy', ['symbol' => $symbol]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @else
                    <form name="addToFavorite"  action="{{route('Favorite-store')}}" method="post" >
                        @csrf
                        <input hidden value="{{$symbol}}" name="symbol">
                        <button type="submit" class="btn btn-primary">Add to favorites</button>
                    </form>
                @endif

{{--                {{dd(session()->get("Favorites"))}}--}}

            </div>
        </div>

    </div>
@endsection

@section('additionalScripts')

    <script>

    function AddToFav(sym)
    {
        $.ajax({
            method: "POST",
            url: "/Favorite/" + sym,
            success: function() {
                alert("Added to favorites!")
            },
            error: function(xhr) {
                console.log(xhr)
                alert('An error occured');
                location.reload();
            }
        })
    }



    </script>

@endsection
