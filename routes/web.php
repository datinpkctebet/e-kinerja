<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/health-check', function() {
    return 'your system running well ^_^';
});

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', 'LoginController@store');
Route::get('login', 'LoginController@store');
Route::post('login', 'LoginController@store');
Route::get('logout', 'LoginController@logout');

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/
Route::get('register', 'LoginController@register');
Route::post('register', 'LoginController@register');


Route::group(['middleware' => 'member'], function()
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('dashboard', 'DashboardController@index');
    Route::post('dashboard', 'DashboardController@store');

    /*
    |--------------------------------------------------------------------------
    | EMPLOYEE
    |--------------------------------------------------------------------------
    */
    Route::get('employee/update/{id}', 'EmployeeController@update');
    Route::post('employee/update/{id}', 'EmployeeController@update');
    Route::post('employee/upload/', 'EmployeeController@upload');
    Route::get('employee/export/{id}', 'EmployeeController@export');

    /*
    |--------------------------------------------------------------------------
    | DIKLAT
    |--------------------------------------------------------------------------
    */
    Route::get('diklat', 'EmployeeDiklatController@index');
    Route::get('diklat/add', 'EmployeeDiklatController@store');
    Route::post('diklat/add', 'EmployeeDiklatController@store');
    Route::get('diklat/update/{id}', 'EmployeeDiklatController@store');
    Route::post('diklat/update/{id}', 'EmployeeDiklatController@store');
    Route::get('diklat/delete/{id}', 'EmployeeDiklatController@destroy');

    /*
    |--------------------------------------------------------------------------
    | KOMPETENSI DIKLAT
    |--------------------------------------------------------------------------
    */
    Route::get('kompetensi-diklat', 'KompetensiDiklatController@index');
    Route::get('kompetensi-diklat/add', 'KompetensiDiklatController@store');
    Route::post('kompetensi-diklat/add', 'KompetensiDiklatController@store');
    Route::get('kompetensi-diklat/update/{id}', 'KompetensiDiklatController@store');
    Route::post('kompetensi-diklat/update/{id}', 'KompetensiDiklatController@store');
    Route::get('kompetensi-diklat/delete/{id}', 'KompetensiDiklatController@destroy');


    Route::group(['middleware' => 'pegawai'], function() {
        /*
        |--------------------------------------------------------------------------
        | PROFILE
        |--------------------------------------------------------------------------
        */
        Route::get('profile', 'EmployeeController@show');

        /*
        |--------------------------------------------------------------------------
        | ACTIVITY
        |--------------------------------------------------------------------------
        */
        Route::get('activity', 'ActivityController@index');
        Route::get('add/activity', 'ActivityController@store');
        Route::post('add/activity', 'ActivityController@store');
        Route::get('activity/edit/{id}', 'ActivityController@store');
        Route::post('activity/edit/{id}', 'ActivityController@store');
        Route::post('activity/check-vol', 'ActivityController@checkVol');
        Route::get('activity/export/{year}/{month}', 'ActivityController@export');
        Route::get('activity/delete/{id}', 'ActivityController@destroy');

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE
        |--------------------------------------------------------------------------
        */
        Route::get('total-nilai', 'EmployeeController@nilai');

        /*
        |--------------------------------------------------------------------------
        | SURAT PENGAJUAN
        |--------------------------------------------------------------------------
        */
        Route::get('surat-pengajuan', 'SuratPengajuanController@index');
        Route::get('surat-pengajuan/add', 'SuratPengajuanController@store');
        Route::post('surat-pengajuan/add', 'SuratPengajuanController@store');
        Route::get('surat-pengajuan/edit/{id}', 'SuratPengajuanController@store');
        Route::post('surat-pengajuan/edit/{id}', 'SuratPengajuanController@store');
        Route::get('surat-pengajuan/delete/{id}', 'SuratPengajuanController@destroy');
    });

    Route::group(['middleware' => 'writer'], function() {
        /*
        |--------------------------------------------------------------------------
        | BLOG
        |--------------------------------------------------------------------------
        */
        Route::get('blog', 'BlogController@index');
        Route::get('blog/add', 'BlogController@store');
        Route::post('blog/add', 'BlogController@store');
        Route::get('blog/edit/{id}', 'BlogController@store');
        Route::post('blog/edit/{id}', 'BlogController@store');
        Route::get('blog/delete/{id}', 'BlogController@destroy');

        /*
        |--------------------------------------------------------------------------
        | GALLERY
        |--------------------------------------------------------------------------
        */
        Route::get('gallery', 'GalleryController@index');
        Route::get('gallery/add', 'GalleryController@store');
        Route::post('gallery/add', 'GalleryController@store');
        Route::get('gallery/edit/{id}', 'GalleryController@store');
        Route::post('gallery/edit/{id}', 'GalleryController@store');
        Route::get('gallery/delete/{id}', 'GalleryController@destroy');
        Route::post('gallery/image/add', 'GalleryController@addImage');
        Route::get('gallery/image/remove/{image_name}', 'GalleryController@removeImage');

        /*
        |--------------------------------------------------------------------------
        | KARIR
        |--------------------------------------------------------------------------
        */
        Route::get('karir', 'KarirController@index');
        Route::get('karir/add', 'KarirController@store');
        Route::post('karir/add', 'KarirController@store');
        Route::get('karir/edit/{id}', 'KarirController@store');
        Route::post('karir/edit/{id}', 'KarirController@store');
        Route::get('karir/delete/{id}', 'KarirController@destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | FORM PEMBERIAN CUTI
    |--------------------------------------------------------------------------
    */
    Route::get('pemberian-cuti', 'PemberianCutiController@index');
    Route::get('pemberian-cuti/{pengajuan_id}', 'PemberianCutiController@store');
    Route::post('pemberian-cuti/{pengajuan_id}', 'PemberianCutiController@store');
    Route::get('pemberian-cuti/edit/{id}', 'PemberianCutiController@store');
    Route::post('pemberian-cuti/edit/{id}', 'PemberianCutiController@store');
    Route::get('pemberian-cuti/delete/{id}', 'PemberianCutiController@destroy');
    Route::get('pemberian-cuti/export/{id}', 'PemberianCutiController@export');
    Route::get('surat-cuti/lock/{id}', 'PemberianCutiController@lock');


    Route::group(['middleware' => 'kapuskesmas'], function() {
        /*
        |--------------------------------------------------------------------------
        | VALIDATON
        |--------------------------------------------------------------------------
        */
        Route::get('validation', 'ValidationActivityController@index');
        Route::get('validation/{id}', 'ValidationActivityController@show');
        Route::get('validation/{id}/accept', 'ValidationActivityController@accept');
        Route::get('validation/{id}/reject', 'ValidationActivityController@reject');
        Route::get('validation/{employee_id}/accept_all', 'ValidationActivityController@accept_all');

        /*
        |--------------------------------------------------------------------------
        | PENILAIAN
        |--------------------------------------------------------------------------
        */
        Route::get('penilaian', 'PenilaianController@index');
        Route::get('penilaian/add', 'PenilaianController@store')->name('penilaian.add');
        Route::post('penilaian/add', 'PenilaianController@store');
        // Route::get('penilaian/edit/{id}', 'PenilaianController@store');
        // Route::post('penilaian/edit/{id}', 'PenilaianController@store');
        Route::get('penilaian/delete/{id}', 'PenilaianController@destroy');

        /*
        |--------------------------------------------------------------------------
        | NILAI KBK
        |--------------------------------------------------------------------------
        */
        Route::get('nilai-kbk', 'NilaiKbkController@index');
        Route::post('nilai-kbk/store', 'NilaiKbkController@store');

        /*
        |--------------------------------------------------------------------------
        | DAFTAR TKD
        |--------------------------------------------------------------------------
        */
        Route::get('nilai-tkd', 'NilaiTkdController@index');
    });


    Route::group(['middleware' => 'absensi'], function() {
        /*
        |--------------------------------------------------------------------------
        | ABSENSI
        |--------------------------------------------------------------------------
        */
        Route::get('absensi', 'AbsensiController@index');
        Route::get('absensi/add', 'AbsensiController@store')->name('absensi.add');
        Route::post('absensi/add', 'AbsensiController@store');
        // Route::get('absensi/edit/{id}', 'AbsensiController@store');
        // Route::post('absensi/edit/{id}', 'AbsensiController@store');
        Route::get('absensi/delete/{id}', 'AbsensiController@destroy');
    });


    Route::group(['middleware' => 'administrator'], function() {
        /*
        |--------------------------------------------------------------------------
        | EMPLOYEE
        |--------------------------------------------------------------------------
        */
        Route::get('employee', 'EmployeeController@index');
        Route::get('employee/add', 'EmployeeController@store');
        Route::post('employee/add', 'EmployeeController@store');
        Route::get('employee/show/{id}', 'EmployeeController@show');
        Route::get('employee/reset/{id}', 'EmployeeController@reset');
        Route::post('employee/reset/{id}', 'EmployeeController@reset');
        Route::get('employee/delete/{id}', 'EmployeeController@destroy');
        Route::get('employee/active/{id}', 'EmployeeController@active');
        Route::get('employee/inactive/{id}', 'EmployeeController@inactive');


        /*
        |--------------------------------------------------------------------------
        | DIKLAT 
        |--------------------------------------------------------------------------
        */
        Route::get('employee-diklat', 'EmployeeDiklatController@employee');
        Route::get('employee-diklat/{id}', 'EmployeeDiklatController@diklatByEmployee');

        /*
        |--------------------------------------------------------------------------
        | KOMPETENSI DIKLAT / GAP ANALYSIS
        |--------------------------------------------------------------------------
        */
        Route::get('employee-kompetensi', 'KompetensiDiklatController@employee');
        Route::get('employee-kompetensi/{id}', 'KompetensiDiklatController@diklatByEmployee');
        Route::get('kompetensi-diklat/approve/{id}/{employee_id}', 'KompetensiDiklatController@approve');
        Route::get('kompetensi-diklat/decline/{id}/{employee_id}', 'KompetensiDiklatController@decline');

        /*
        |--------------------------------------------------------------------------
        | VARIABLE
        |--------------------------------------------------------------------------
        */
        Route::get('variable', 'VariableController@index');
        Route::get('variable/add', 'VariableController@store');
        Route::post('variable/add', 'VariableController@store');
        Route::get('variable/edit/{id}', 'VariableController@store');
        Route::post('variable/edit/{id}', 'VariableController@store');
        Route::get('variable/delete/{id}', 'VariableController@destroy');

        /*
        |--------------------------------------------------------------------------
        | PROFESSION
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix' => 'profession'], function(){
            Route::get('/', 'ProfessionController@index');
            Route::get('/add', 'ProfessionController@store');
            Route::post('/add', 'ProfessionController@store');
            Route::get('/edit/{id}', 'ProfessionController@store');
            Route::post('/edit/{id}', 'ProfessionController@store');
            Route::get('/delete/{id}', 'ProfessionController@destroy');

            Route::get('{profession_id}', 'TupoksiController@index');
            Route::get('{profession_id}/add', 'TupoksiController@store');
            Route::post('{profession_id}/add', 'TupoksiController@store');
            Route::get('{profession_id}/edit/{id}', 'TupoksiController@store');
            Route::post('{profession_id}/edit/{id}', 'TupoksiController@store');
            Route::get('{profession_id}/delete/{id}', 'TupoksiController@destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | QUESTION
        |--------------------------------------------------------------------------
        */
        Route::get('question', 'QuestionController@index');
        Route::get('question/add', 'QuestionController@store');
        Route::post('question/add', 'QuestionController@store');
        Route::get('question/edit/{id}', 'QuestionController@store');
        Route::post('question/edit/{id}', 'QuestionController@store');
        Route::get('question/delete/{id}', 'QuestionController@destroy');

        /*
        |--------------------------------------------------------------------------
        | SURAT TUGAS
        |--------------------------------------------------------------------------
        */
        Route::get('surat-tugas', 'SuratTugasController@index');
        Route::get('surat-tugas/add', 'SuratTugasController@store');
        Route::post('surat-tugas/add', 'SuratTugasController@store');
        Route::get('surat-tugas/edit/{id}', 'SuratTugasController@store');
        Route::post('surat-tugas/edit/{id}', 'SuratTugasController@store');
        Route::get('surat-tugas/delete/{id}', 'SuratTugasController@destroy');
        Route::get('surat-tugas/export/{id}', 'SuratTugasController@export');

        /*
        |--------------------------------------------------------------------------
        | SURAT PENGAJUAN
        |--------------------------------------------------------------------------
        */
        Route::get('surat-cuti', 'SuratPengajuanController@index');
        Route::get('surat-cuti/accept/{id}', 'SuratPengajuanController@accept');
        Route::get('surat-cuti/decline/{id}', 'SuratPengajuanController@decline');
        Route::get('surat-cuti/delete/{id}', 'SuratPengajuanController@destroy');


         /*
        |--------------------------------------------------------------------------
        | SURAT PEMBERIAN CUTI
        |--------------------------------------------------------------------------
        */
        Route::get('pemberian-cuti2', 'SuratPemberianController@index');
        Route::get('pemberian-cuti2/add', 'SuratPemberianController@store');
        Route::post('pemberian-cuti2/add', 'SuratPemberianController@store');
        Route::get('pemberian-cuti2/edit/{id}', 'SuratPemberianController@store');
        Route::post('pemberian-cuti2/edit/{id}', 'SuratPemberianController@store');
        Route::get('pemberian-cuti2/delete/{id}', 'SuratPemberianController@destroy');
        Route::get('pemberian-cuti2/export/{id}', 'SuratPemberianController@export');

        /*
        |--------------------------------------------------------------------------
        | SETUP SURAT PEMBERIAN CUTI
        |--------------------------------------------------------------------------
        */
        Route::get('setup-form-cuti', 'SetupFormCutiController@index');
        Route::get('setup-form-cuti/add', 'SetupFormCutiController@store');
        Route::post('setup-form-cuti/add', 'SetupFormCutiController@store');
        Route::get('setup-form-cuti/edit/{id}', 'SetupFormCutiController@store');
        Route::post('setup-form-cuti/edit/{id}', 'SetupFormCutiController@store');
        Route::get('setup-form-cuti/delete/{id}', 'SetupFormCutiController@destroy');
    });
});
