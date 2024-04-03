<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Profile extends Controller
{
    public function get_user_profile($number)
    {
        try {
            if (Auth::check() && Auth::user()->number === $number) {

                $user = User::where('number', $number)->first();

                if ($user->number === Auth::user()->number) {
                    return view('users.v_user_profile', compact('user'));
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
