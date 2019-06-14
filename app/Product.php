<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    
    // to call out the parent class

    // public function warehouse(){
    //     return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    // }

    public function purchase(){
       return $this->hasOne(Purchase::class);
    }

   //  public function company(){
   //     return $this->belongsTo(Company::class);
   //  }

    public function supplier(){
       return $this->belongsTo(Supplier::class);
    }



    // to inverse
    public function stock(){
        return $this->hasOne(Stock::class );
    }

    public function inventory(){
        return $this->hasMany(Inventory::class );
    }

    public function assign(){
        return $this->hasOne(Assign::class );
    }

    public function requisition(){
      return $this->hasMany(Requisition::class );
    }


    // SCOPE
    public function scopeStatusName(){
       return[
        1 => 'Available',
        2 => 'Unavailable'
       ];
    }
    public function scopeCategoryStatus(){
       return[
        1 => 'Usable',
        2 => 'Re-Usable'
       ];
    }
    public function scopeActiveStatus(){
       return[
        1 => 'OKAY',
        2 => 'NOT IN-SERVICE',
        3 => 'LOST',
        4 => 'REPAIRING'
       ];
    }
    public function scopePurchaseStatus(){
       return[
        1 => 'Available',
        2 => 'Purchased'
       ];
    }
}
