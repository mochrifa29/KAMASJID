<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth extends Controller
{
     public function index(){
        
        $data = [
            'title' => 'KAMASJID'
        ];

        return view('auth.login.index',$data);
    }
}
