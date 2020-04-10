<?php

namespace Tir\Store\Attribute\Entities;

use Tir\Crud\Support\Eloquent\CrudModel;
use Astrotomic\Translatable\Translatable;

class AttributeValue extends CrudModel 
{
    //Additional trait insert here
    
    use Translatable;


    public $table = 'attribute_values';

    protected $fillable = ['value','position'];

    public $translatedAttributes = ['value'];



}
