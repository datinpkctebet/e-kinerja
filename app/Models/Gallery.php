<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gallery extends Model
{
    use SoftDeletes;

    /**
    * The collection associated with the model.
    *
    * @var string
    */
    protected $collection = 'galleries';

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = ['id'];

    /**
    * Attributes that are primary field.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['created_at', 'updated_at'];


    /**
    * The attributes that are appends.
    *
    * @var array
    */
    protected $appends = [
        'image_url',
        'array_image',
    ];

    /**
    *
    * @return string
    */
    public function getImageUrlAttribute()
    {
        $path = env('PATH_GALLERY');

        return \URL::to('/') .'/'. $path .'/'. $this->primary_image;
    }

    /**
    *
    * @return string
    */
    public function getArrayImageAttribute()
    {
        $path = env('PATH_GALLERY');

        $array_image = [];
        $images = explode(",", $this->image);
        for ($i=0; $i < count($images); $i++) {
            $image_url = \URL::to('/') .'/'. $path .'/'. $images[$i];
            array_push($array_image, $image_url);
        }

        return $array_image;
    }
}
