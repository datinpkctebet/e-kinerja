<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenangguhanCuti extends Model
{
    use SoftDeletes;
    protected $table = 'penangguhan_cuti';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['month', 'is_active', 'description'];
}
