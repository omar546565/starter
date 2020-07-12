<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;

class RelationsController extends Controller
{
   public function hasOneRelation(){
       /*  \App\User::where('id',15) -> first(); */
       $user = \App\User::with(['phone' => function($q){
           $q -> select('code','phone','user_id');
       }])->find(10);

   //  return  $user -> phone -> code;
       // $phone = $user -> phone;
       return response() -> json($user);

   }

   public function hasOneRelationReverse(){

   // $phone = Phone::with('user') ->find(1);
  $phone = Phone::with(['user' => function($q){
   $q -> select ('id','name');
     }]) ->find(1);

       // make visble
       $phone -> makeVisible(['user_id']);
     //  $phone -> makehidden(['code']);


      //return $phone -> user ;
    //   return $phone -> phone;
    return $phone ;

   }

   public function getUserHasPhone(){


  return   User::whereHas('phone') -> get();


   }
   public function getUserNotHasPhone(){


    return   User::whereDoesntHave('phone') -> get();

   }

   public function getUserHasPhoneWithCondition(){

       return   User::whereHas('phone',function ($q){
           $q -> where('code','02');
       }) -> get();

   }


   ############### one to many relationship methdods#########
    public function getHospitalDoctors(){

     $hospital = Hospital::find(1); // Hospital::where('id',1) -> first; // Hospital::first;

      //   return $hospital -> doctors;
          $hospital = Hospital::with('doctors') ->find(1);
      //  return  $hospital -> name;



        $doctors = $hospital -> doctors;

     /*   foreach ($doctors as $doctor){
            echo $doctor -> name.'<br>';
        } */
        $doctor = Doctor::find(3);
        return   $doctor -> hospital -> name.'<br>' ;


    }

public function hospitals(){
 $hospitals = Hospital::select('id','name', 'address')->get();
return view('doctors.hospitals',compact('hospitals'));

}
public function doctors($hospital_id){

    $hospital = Hospital::find($hospital_id);

    $doctors = $hospital -> doctors;

    return view('doctors.doctors',compact('doctors'));
}





}
