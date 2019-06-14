<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    // to call out the child class
   public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    // to inverse
    public function purchase(){
       return $this->hasMany(Purchase::class);
    }
    public function product(){
       return $this->belongsTo(Product::class);
    }
}
