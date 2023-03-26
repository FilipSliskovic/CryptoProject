<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToFavoriteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use function Sodium\add;

class FavoritesController extends FrontEndController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $favs = \session('Favorites');
        if (!$favs)
        {
            $favs = 'You have no favorite pairs';
        }


        return view('Pages.Favorites',['data' => $favs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddToFavoriteRequest $request)
    {




//        dd($favorites);
        try {

            $favs = session('Favorites', []);

            if (!in_array($request->symbol , $favs))
            {
                array_push($favs,$request->symbol);
                session()->put('Favorites', $favs);

            }
            else{
                session(['Favorites' => $favs]);
            }


            Log::info("User added " . $request->symbol ." to favorites",['User' => session()->get("User")->name]);

            return redirect()->back()->with('success-msg', "Successfully added to favorites!");
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return redirect()->back()->with("error","An error has occurred!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $symbol)
    {




//
        try {

           if (empty(session('Favorites'))){

               return redirect()->back()->with("error","An error has occurred!");
           }
            if (!in_array($symbol , session('Favorites'))) {

                return redirect()->back()->with('error', 'The pair you want to delete is not in the favorites.');
            }
            $array = \session('Favorites');
            $key = array_search($symbol,$array);
            unset($array[$key]);
            $array = array_values($array);
            \session(['Favorites' => $array]);
            return redirect()->back()->with('success-msg', 'The pair has been removed from your favorites.');
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return redirect()->back()->with("error","An error has occurred!");
        }

    }
}
