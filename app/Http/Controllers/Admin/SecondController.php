<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecondController extends Controller
{

    public function  __construct(){
      $this -> middleware('auth')->except( 'showString1');
      }


    public function  showString0(){
      return 'ok0';
    }
    public function  showString1(){
        return 'ok1';
      }
       public function  showString2(){
        return 'ok2';
      }
       public function  showString3(){
        return 'ok3';
      }
       public function  showString4(){
        return 'ok4';
      }
}
