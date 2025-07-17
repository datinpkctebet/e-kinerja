<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Karir extends Model
{
    use SoftDeletes;

    /**
    * The collection associated with the model.
    *
    * @var string
    */
    protected $collection = 'karirs';

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
        'date',
        'month',
        'sort_description',
        'image_url',
        'document_url',
    ];

    /**
    *
    * @return string
    */
    public function getDateAttribute()
    {
        $dt = Carbon::parse($this->created_at);

        $dt = $dt->isoFormat('D');

        return $dt;
    }

    /**
    *
    * @return string
    */
    public function getMonthAttribute()
    {
        $dt = Carbon::parse($this->created_at);

        $dt = $dt->isoFormat('MMMM');

        return $dt;
    }

    /**
    *
    * @return string
    */
    public function getSortDescriptionAttribute()
    {
        $string = $this->description;

        // get first paragraph
        $string = substr($string, strpos($string, "<p"), strpos($string, "</p>")+4);

        // remove paragraph tag
        $string = str_ireplace("<p>", "", $string);
        $string = str_ireplace("</p>", "", $string);

        return $string;
    }

    /**
    *
    * @return string
    */
    public function getImageUrlAttribute()
    {
        if (!$this->image) return '';

        $path = env('PATH_KARIR_IMAGE');

        return \URL::to('/') .'/'. $path .'/'. $this->image;
    }

    /**
    *
    * @return string
    */
    public function getDocumentUrlAttribute()
    {
        if (!$this->document) return '';

        $path = env('PATH_KARIR_DOCUMENT');

        return \URL::to('/') .'/'. $path .'/'. $this->document;
    }
}
