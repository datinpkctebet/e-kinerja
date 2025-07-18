<?php

use Carbon\Carbon;

/**
 * Encrypt string.
 *
 * @param  string $string
 * @return string
 */
if (!function_exists('encryptor'))
{
  function encryptor(string $string)
  {
    $password   = env('APP_KEY', 'default');
    $cryptor  = new \RNCryptor\RNCryptor\Encryptor;

    return $cryptor->encrypt($string, $password);
  }
}

/**
 * Decrypt string.
 *
 * @param  string $string
 * @return string
 */
if (!function_exists('decryptor'))
{
  function decryptor(string $string)
  {
    // $password   = env('APP_KEY', 'default');
    $password   = config('app.key');;
    $cryptor  = new \RNCryptor\RNCryptor\Decryptor;

    return $cryptor->decrypt($string, $password);
  }
}

/**
 * Set list menu.
 *
 * @return string $array
 */
if (!function_exists('setMenu'))
{
    function setMenu()
    {
        $admin = [
            [
                'name' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'flaticon2-architecture-and-city',
            ],
            [
                'name' => 'Data Pegawai',
                'url' => 'employee',
                'icon' => 'flaticon-users-1',
            ],
            [
                'name' => 'Diklat',
                'url' => 'employee-diklat',
                'icon' => 'flaticon2-contract',
            ],
            [
                'name' => 'Kompetensi Diklat',
                'url' => 'employee-kompetensi',
                'icon' => 'flaticon-doc',
            ],
            [
                'name' => 'Atur Variabel',
                'url' => 'variable',
                'icon' => 'flaticon-interface-1',
            ],
            [
                'name' => 'Daftar Profesi',
                'url' => 'profession',
                'icon' => 'flaticon-suitcase',
            ],
            [
                'name' => 'Buat Pertanyaan',
                'url' => 'question',
                'icon' => 'flaticon-questions-circular-button',
            ],
            [
                'name' => 'Surat Tugas',
                'url' => 'surat-tugas',
                'icon' => 'flaticon-multimedia',
            ],
            [
                'name' => 'Pengajuan Cuti Pegawai',
                'url' => 'surat-cuti',
                'icon' => 'flaticon-notes',
            ],
            [
                'name' => 'Persetujuan Cuti oleh Pimpinan',
                'url' => 'pemberian-cuti',
                'icon' => 'flaticon-calendar-1',
            ],
            [
                'name' => 'Form Lampiran Pemberian Cuti',
                'url' => 'pemberian-cuti2',
                'icon' => 'flaticon-calendar-1',
            ],
            [
                'name' => 'Setup Form Pemberian Cuti',
                'url' => 'setup-form-cuti',
                'icon' => 'flaticon-settings',
            ],
        ];

        $employee = [
            [
                'name' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'flaticon2-architecture-and-city',
            ],
            [
                'name' => 'Profile',
                'url' => 'profile',
                'icon' => 'flaticon2-user',
            ],
            [
                'name' => 'Diklat',
                'url' => 'diklat',
                'icon' => 'flaticon2-contract',
            ],
            [
                'name' => 'Kompetensi Diklat',
                'url' => 'kompetensi-diklat',
                'icon' => 'flaticon-doc',
            ],
            [
                'name' => 'Input Aktifitas',
                'url' => 'add/activity',
                'icon' => 'flaticon-time-3',
            ],
            [
                'name' => 'Lihat Aktifitas',
                'url' => 'activity',
                'icon' => 'flaticon-clipboard',
            ],
            [
                'name' => 'Rekap Absensi dan TKD',
                'url' => 'total-nilai',
                'icon' => 'flaticon2-pie-chart-4',
            ],
            [
                'name' => 'Pengajuan Cuti',
                'url' => 'surat-pengajuan',
                'icon' => 'flaticon-calendar-1',
            ],
        ];

        $kapuskes = [
            [
                'name' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'flaticon2-architecture-and-city',
            ],
            [
                'name' => 'Validasi Kegiatan Pegawai',
                'url' => 'validation',
                'icon' => 'flaticon-event-calendar-symbol',
            ],
            [
                'name' => 'Penilaian Kerja Pegawai',
                'url' => 'penilaian',
                'icon' => 'flaticon-statistics',
            ],
            [
                'name' => 'Pengaturan Nilai KBK',
                'url' => 'nilai-kbk',
                'icon' => 'flaticon-cogwheel-1',
            ],
            [
                'name' => 'Daftar TKD Pegawai',
                'url' => 'nilai-tkd',
                'icon' => 'flaticon-layer',
            ],
        ];

        $absensi = [
            [
                'name' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'flaticon2-architecture-and-city',
            ],
            [
                'name' => 'Absensi Pegawai',
                'url' => 'absensi',
                'icon' => 'flaticon-alert',
            ],
        ];

        $writer = [
            [
                'name' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'flaticon2-architecture-and-city',
            ],
            [
                'name' => 'Blog',
                'url' => 'blog',
                'icon' => 'flaticon2-writing',
            ],
            [
                'name' => 'Gallery',
                'url' => 'gallery',
                'icon' => 'flaticon2-photo-camera',
            ],
            [
                'name' => 'Karir',
                'url' => 'karir',
                'icon' => 'flaticon2-mail-1',
            ],
        ];

        $privilege = session('employee')['privilege'];

        if ($privilege === 'Administrator') {
            return $admin;
        } else if ($privilege === 'Kapuskesmas') {
            return $kapuskes;
        } else if ($privilege === 'Absensi') {
            return $absensi;
        } else if ($privilege === 'Writer') {
            return $writer;
        } else {
            return $employee;
        }
    }
}

/**
 * Set is add or edit url.
 *
 * @return string $url
 */
if (!function_exists('setPostUrl'))
{
    function setPostUrl()
    {
        $main = url("/");
        $full = url()->current();

        if ($main == $full) {
            $full = $full ."/login";
        }

        $current = explode(url("/"), $full);

        return $current[1];
    }
}

/**
 * Set is add or edit url.
 *
 * @return string $url
 */
if (!function_exists('setParamUrl'))
{
    function setParamUrl($value)
    {
        if (app('request')->has('month') && app('request')->has('year')) {
            $month = app('request')->input('month');
            $year = app('request')->input('year');

            $url = $value;
            $url .= '?month='. $month;
            $url .= '&year='. $year;

            return $url;
        }

        return $value;
    }
}

/**
 * Label active inactive employee.
 *
 * @param boolean $isActive
 * @return string $html
 */
if (!function_exists('isActiveHtml'))
{
    function isActiveHtml($isActive)
    {
        if ($isActive) {
            return '<span class="kt-badge kt-badge--inline kt-badge--success">Aktif</span>';
        } else {
            return '<span class="kt-badge kt-badge--inline kt-badge--danger">Non Aktif</span>';
        }
    }
}

/**
 * Label active inactive employee.
 *
 * @param boolean $isActive
 * @return string $html
 */
if (!function_exists('isVerifyHtml'))
{
    function isVerifyHtml($status)
    {
        if (empty($status)) {
            return '-';
        } else if ($status == 2) {
            return '<span class="kt-badge kt-badge--inline kt-badge--danger">ditolak</span>';
        } else {
            return '<span class="kt-badge kt-badge--inline kt-badge--success">diterima</span>';
        }
    }
}

/**
 * Make rupiah format.
 *
 * @param integer $value
 * @return string
 */
if (!function_exists('rupiahFormat'))
{
    function rupiahFormat($value)
    {
        return 'Rp. '. number_format($value, 0, ".", ",");
    }
}

/**
 * Get download document.
 * if there is file
 *
 * @param integer $value
 * @return string
 */
if (!function_exists('getDowloadDocument'))
{
    function getDowloadDocument($name)
    {
        if ($name) {
            return '<a href="'. asset(env('PATH_DOCUMENT')) .'/'. $name .'">download</a>';
        }
    }
}

/**
 * check if is admin
 *
 * @return boolean
 */
if (!function_exists('isAdmin'))
{
    function isAdmin()
    {
        if (session('employee')['privilege'] === 'Administrator') return true;

        return false;
    }
}

/**
 * check if is admin
 *
 * @return boolean
 */
if (!function_exists('parseMenuUrl'))
{
    function parseMenuUrl($url)
    {
        $new_url = explode("/", $url);

        return $new_url[0];
    }
}

/**
 * check if is admin
 *
 * @return boolean
 */
if (!function_exists('formatJenisKelamin'))
{
    function formatJenisKelamin($jenis_kelamin)
    {
        if ($jenis_kelamin === 'M') return 'Laki-Laki';

        if ($jenis_kelamin === 'F') return 'Perempuan';
    }

}

/**
 * check if image was null
 *
 * @return boolean
 */
if (!function_exists('isImage'))
{
    function isImage($dir, $image)
    {
        if(\File::isFile($dir .'/'. $image)){
            return asset($dir .'/'. $image);
        }
    }
}


/**
 * check if image was null
 *
 * @return boolean
 */
if (!function_exists('minusMonth'))
{
    function minusMonth()
    {
        $dateNow = Carbon::now();

        return $dateNow->subMonth();
    }
}

/**
 * Get year only in date
 *
 * @return boolean
 */
if (!function_exists('getYear'))
{
    function getYear($date)
    {
        return Carbon::parse($date)->year;
    }
}

/**
 * Get year only in date
 *
 * @return boolean
 */
if (!function_exists('dateFormat'))
{
    function dateFormat($date)
    {
        $dt = Carbon::parse($date);

        $dt = $dt->isoFormat('D MMMM YYYY');

        return $dt;
    }
}

/**
 * Get list of years, from 2018 to now
 *
 * @return boolean
 */
if (!function_exists('getListYears'))
{
    function getListYears()
    {
        $currentYear = date("Y"); // Get the current year

        $years = range(2018, $currentYear);

        // Optional: You can sort the array in descending order
        // $years = array_reverse($years);

        return $years;
    }
}

