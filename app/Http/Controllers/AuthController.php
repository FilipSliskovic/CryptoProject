<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends FrontEndController
{
    public function LoginUser()
    {

        $user = new \stdClass();

        $user->name = 'Test';
        $user->password = 'Password123';


        try {


            session(['User'=>$user]);
            Log::info('User Logged in.',['Name: ' => $user->name]);

            return redirect()->route('Home-index');
        }
        catch (\Exception $e)
        {
            $userTicket = uuid_create();
            Log::error($userTicket . " " . $e->getMessage());
            return redirect()->back()->with('error-msg',"Error occurred, your ticked number is: " . $userTicket);
        }
    }
}
