<?php

namespace App;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name','address'];
    protected $casts = [
        'mobile2'=> 'nullable'
    ];
    protected $fillable = ['mobile'];

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
