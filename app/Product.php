<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';


    public function category() {
        return $this->hasOne('App\Category','id','category_id');
    }

    public function vendor() {
        return $this->hasOne('App\Vendor','id','vendor_id');
    }
}
