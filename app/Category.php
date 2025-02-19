<?php

namespace App;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];

    public $translatedAttributes = ['name'];
    protected $fillable = [];

    public function products(){
       return $this->hasMany(Product::class);
    }

}
