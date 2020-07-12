<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{

  use  OfferTrait;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function getOffers()
    {
        return Offer::select('id','name')->get();
    }

   /* public function store()
    {
         Offer::create([
            'name' => 'offer3',
            'price' => '5000',
            'details' => 'offer details',
             ]);
    }*/

    public function create(){
     return view('offers.create');

    }


    public function store(OfferRequest $request)
    {




       // $rules =  $this -> getRules();
       // $messages =  $this -> getMessages();
      //  $validator = Validator::make($request ->all(),$rules,$messages);
      //  if($validator -> fails()){

      //      return  redirect()->back()->withErrors($validator)->withInputs($request ->all());
      //  }


      $file_name =  $this -> saveImage($request -> photo , 'images/offers' );


         //insert
        Offer::create([
            'photo' => $file_name,
            'name' => $request -> name,
            'price' => $request -> price,
            'details' => $request -> details,
             ]);
             return  redirect()->back()->with(['success' => 'تم إضافة العرض بنجاح']);

    }













    public function getAllOffers()
        {
            $offers = Offer::select('id','name','price','details','photo') ->get();

            return view('offers.all',compact('offers'));

       }

       public function editoffer($offer_id){

        //Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
       if(!$offer)

        return  redirect()-> back() ;

        $offer =   Offer::select('id','name','price','details','photo') ->find($offer_id);
        return view('offers.edit',compact('offer'));

       }

       public function delete($offer_id){

           $offer = Offer::find($offer_id);
           if(!$offer)

               return  redirect()-> back() -> with(['error' => 'العرض غير موجود']) ;
            $offer -> delete();
               return  redirect()->route('offers.all')  -> with(['success' => 'تم حذف العرض']) ;
       }


       public function UpdateOffer(OfferRequest $request,$offer_id){

        $file_name =  $this -> saveImage($request -> photo , 'images/offers' );
        $offer =   Offer::find($offer_id);
         if(!$offer)
        return  redirect()-> back() ;
        $offer -> update([
            'photo' => $file_name,
            'name' => $request -> name,
            'price' => $request -> price,
            'details' => $request -> details,
        ]);
       // $offer -> update($request ->all());
        return  redirect()->back()->with(['success' => 'تم تعديل العرض بنجاح']);


       }



/*
    protected function getMessages(){
     return      $messages =[

        'name.required' =>trans( 'messages.offer name required'),
        'name.max' =>__( 'messages.offer name max'),
        'name.unique' =>__( 'messages.offer name unique'),
        'price.numeric' =>__( 'messages.offer price numeric'),
    ];
    }
    protected function getRules(){
        return      $rules =[

            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required' ];
       }
       */

      public function getVideo(){
           $video = Video::first();
           event(new VideoViewer($video));
           return view ('video') -> with('video',$video);
            }


}
