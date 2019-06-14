<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Controllers\EmployeeHasProductController;

class Assign extends Model
{
      // use SoftDeletes;
      protected $guarded = [];
      protected $dates = ['deleted_at'];

    public function employee_has_product(){
       return $this->hasMany(employee_has_product::class, 'id', 'assign_id');
    }
    public function product(){
       return $this->belongsTo(Product::class);
    }

    public function company(){
       return $this->belongsTo(Company::class);
    }

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function stock(){
       return $this->belongsTo(Stock::class);
    }
}
