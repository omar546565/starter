<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";
    protected $fillable=['name','price','photo','details','status','created_at','updated_at'];
    protected $hidden =['created_at','updated_at'];
    //public $timestamps = false;

   //register global scope
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OfferScope());
    }


    ######################## local scopes ############
    public function scopeInactive($query){
      return  $query -> where('status',0);

    }
    public function scopeInvalid($query){
      return  $query -> where('status',0)->whereNull('details');

    }
   #####################################################

    //mutators

    public function setNameAttribute($value){
        $this -> attributes['name'] = strtoupper($value);

    }


}
