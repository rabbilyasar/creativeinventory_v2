<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee_has_product extends Model
{
    // use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function assign(){
       return $this->belongsTo(Assign::class);
    }
    public function user(){
       return $this->belongsTo(User::class);
    }
}