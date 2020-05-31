<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function getIndex(){


       $data=['omar', 'hasan'];

       /* $obj = new \stdClass();

       $obj -> name = 'ahmed';
       $obj -> id = 66;
       $obj -> gender = 'male'; */
        return view('welcome',compact('data'));
    }
}
