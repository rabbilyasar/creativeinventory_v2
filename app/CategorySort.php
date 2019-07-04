<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorySort extends Model
{
    protected $guarded = [];

    public function product ()
    {
        return $this->belongsTo(Product::class);
    }
    public function category ()
    {
        return $this->belongsTo(Category::class);
    }
}
