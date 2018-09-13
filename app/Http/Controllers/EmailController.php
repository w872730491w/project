<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;

class EmailController extends Controller
{
    use RegistersUsers;

    public function activation(Request $request)
    {
        $user = User::where('confirmation_token', $request->only('token'))->where('is_active', 0)->first();

        // dump($user); // debug

        if(!is_null( $user )){

            $user->is_active = 1;
            $user->confirmation_token = str_random(32);
            $user->save();

        }

        return redirect('login');
    }
}
