<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CommanController extends Controller
{
    public function dashboardPage()
    {
        $userData = User::get();
        return view('dashboard', [
            'data' => $userData
        ]);
    }

    public function homePage()
    {
        return view('authentication.home');
    }

    //Authentication methods
    public function registerPage()
    {
        return view('authentication.register');
    }

    public function loginPage()
    {

        return view('authentication.login');
    }
}
