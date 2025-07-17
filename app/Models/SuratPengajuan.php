<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratPengajuan extends Model
{
    use SoftDeletes;

    /**
    * The collection associated with the model.
    *
    * @var string
    */
    protected $collection = 'surat_pengajuans';

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
        'selama',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        // 'employee',
        // 'penanggung_jawab_employee',
        // 'atasan_setup1',
        // 'atasan_setup',
        // 'pejabat_berwenang_setup',
    ];

    /**
    * Get lenght of work attributes.
    *
    * @return string
    */
    public function getSelamaAttribute()
    {
        $diff_in_months = '-';

        if ($this->mulai) {
            $from = Carbon::parse($this->mulai);
            $to = Carbon::parse($this->selesai)->addDays(1);
            $diff_in_months = $to->diff($from)->format('%m bulan %d hari');
        }

        return $diff_in_months;
    }

    /**
     * Get the comments for the blog post.
     */
    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function penanggung_jawab_employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'penanggung_jawab');
    }

    /**
     * Get the comments for the blog post.
     */
    public function atasan_setup1()
    {
        return $this->hasOne('App\Models\Setup', 'id', 'atasan1');
    }

    /**
     * Get the comments for the blog post.
     */
    public function atasan_setup()
    {
        return $this->hasOne('App\Models\Setup', 'id', 'atasan');
    }

    /**
     * Get the comments for the blog post.
     */
    public function pejabat_berwenang_setup()
    {
        return $this->hasOne('App\Models\Setup', 'id', 'pejabat_berwenang');
    }
}
