<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
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


public function hospitalsHasDoctor(){

  return  $hospitals =  Hospital::whereHas('doctors')->get();
}

public function hospitalsHasOnlyMaleDoctors(){

    return  $hospitals =  Hospital::with('doctors')->whereHas('doctors', function($q){

        $q  ->  where('gender', 2);
    } )->get();
}

  public function hospitalsNotHasDoctors(){

   return  $hospitals =  Hospital::whereDoesntHave('doctors')->get();

  }

  public function deleteHospital($hospital_id){

      $hospital =  Hospital::find($hospital_id) ;

      if(!$hospital)
          return abort('404');

     // $hospital -> delete();
      $hospital -> doctors() -> delete();
      $hospital -> delete();

      return redirect() -> route('hospitals.all');
  }

  public function getDoctorServices(){

     return  $doctor = Doctor::with('services')->find(3);
  // return   $doctor -> services;

  }

  public function getServiceDoctors(){

  //return    $doctor = Service::with('doctors')->find(1);
  return    $doctor = Service::with(['doctors' => function($q){

      $q -> select('doctors.id','name','title');
  }])->find(1);

}
        public function getDoctorServicesById($doctorId){

            $doctor = Doctor::find($doctorId);
            $services = $doctor -> services;

            $doctors = Doctor::select('id','name') ->get();
            $allservices = Service::select('id','name') ->get();

            return view('doctors.services',compact('services','doctors','allservices'));

        }

        public function saveServicesToDoctors(Request $request){

       $doctor =   Doctor::find($request -> doctor_id);
          if(!$doctor)
              return abort('404');

        //  $doctor ->services()-> attach($request -> servicesIds);

         //   $doctor ->services()-> sync($request -> servicesIds); //حذف الكل مع إضافة الجديد

//إضافة الجديد مع بقاء القديم //
            $doctor ->services()-> syncWithoutDetaching($request -> servicesIds);
          return  'success';

        }


        public function getPatientDoctor(){

            $patient = Patient::find(2);

         return   $patient -> doctor;

        }

        public function getCountryDoctor(){

                $country  = Country::find(1);

            return   $country ->  doctors;

        }


        public function getDoctors(){

  return   $doctors =  Doctor::select('id','name','gender')-> get();

  /*   if(isset($doctors) && $doctors -> count() >0){
         foreach ($doctors as $doctor){

             $doctor -> gender = $doctor -> gender == 1 ? 'male':'femal';

         }
     }
     return $doctors;*/

     }

}
