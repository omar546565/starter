<?php

namespace App\Http\Controllers;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    use OfferTrait;
    public  function  create(){

     return view('ajaxoffers.create');

    }
    public  function  store(OfferRequest $request){

        $file_name =  $this -> saveImage($request -> photo , 'images/offers' );


        //insert
     $offer =  Offer::create([
           'photo' => $file_name,
            'name' => $request -> name,
            'price' => $request -> price,
            'details' => $request -> details,
        ]);
      if ($offer)
        return response() -> json([
           'status' =>  true,
           'msg' =>  'تم الحفظ بنجاح ',

        ]);
       else

           return response() -> json([
               'status' =>  false,
               'msg' =>  'تم فشل الحفظ ',

           ]);

    }
    public  function  nameconfirm(Request $request){
      $price =  $request -> price;

        $offer = Offer::where('price',$price)->count('price');

      if ($offer > 0)
        return response() -> json([
           'status' =>  true,
           'msg' =>  'الرقم موجود اختر غيره',

        ]);
       else

           return response() -> json([
               'status' =>  false,
               'msg' =>  'الرقم متوفر ',

           ]);

    }

    public  function  all(){
               $offers = Offer::select('id','name','price','details','photo') ->get();

        return view('ajaxoffers.all',compact('offers'));

    }

    public function delete(Request $request){

        $offer = Offer::find($request -> id);
        if(!$offer)

            return  redirect()-> back() -> with(['error' => 'العرض غير موجود']) ;
        $offer -> delete();
        return response() -> json([
            'status' =>  true,
            'msg' =>  'تم الحذف بنجاح ',
            'id' =>  $request -> id

        ]);



    }
    public function edit(Request $request){

        //Offer::findOrFail($offer_id);
        $offer = Offer::find($request -> offer_id);
        if(!$offer)

            return response() -> json([
                'status' =>  false,
                'msg' =>  'العرض غير موجود ',

            ]);

        $offer =   Offer::select('id','name','price','details','photo') ->find($request -> offer_id);
        return view('ajaxoffers.edit',compact('offer'));

    }

    public function update(OfferRequest $request){

        $file_name =  $this -> saveImage($request -> photo , 'images/offers' );
        $offer =   Offer::find($request -> offer_id);
        if(!$offer)
            return response() -> json([
                'status' =>  false,
                'msg' =>  'العرض غير موجود ',

            ]);
        $offer -> update([
            'photo' => $file_name,
            'name' => $request -> name,
            'price' => $request -> price,
            'details' => $request -> details,
        ]);
        // $offer -> update($request ->all());
        return response() -> json([
            'status' =>  true,
            'msg' =>  'تم الحذف بنجاح ',
            'id' =>  $request -> id

        ]);


    }

}
