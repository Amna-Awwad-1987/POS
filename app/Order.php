<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded =[];
    protected $fillable=['quantity','totalPrice','client_id'];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class, 'order_product');
    }
}
