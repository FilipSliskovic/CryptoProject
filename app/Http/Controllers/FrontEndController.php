<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function getApi($url)
    {
        $httpClient = new \GuzzleHttp\Client();
        $request =
            $httpClient
                ->get($url);

        $response = json_decode($request->getBody()->getContents());
        return $response;
    }
}
