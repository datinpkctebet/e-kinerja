<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratPemberian extends Model
{
    use SoftDeletes;

    /**
    * The collection associated with the model.
    *
    * @var string
    */
    protected $collection = 'surat_pemberians';

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
        'list_employee',
    ];

    /**
    * Get Unit Kerja from db units.
    *
    * @return string
    */
    public function getListEmployeeAttribute()
    {
        $pesertas = explode(",", $this->peserta);

        $data = Employee::whereIn('id', $pesertas)->get();

        return $data;
    }
}
