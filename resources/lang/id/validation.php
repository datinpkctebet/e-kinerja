<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Masukan :attribute harus diterima.',
    'active_url'           => 'Masukan :attribute bukan URL yang valid.',
    'after'                => 'Masukan :attribute harus berupa tanggal setelah :date.',
    'after_or_equal'       => 'Masukan :attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha'                => 'Masukan :attribute hanya boleh berisi huruf.',
    'alpha_dash'           => 'Masukan :attribute hanya boleh berisi huruf, angka, dan tanda hubung.',
    'alpha_num'            => 'Masukan :attribute hanya boleh berisi huruf dan angka.',
    'array'                => 'Masukan :attribute harus berupa array.',
    'before'               => 'Masukan :attribute harus berupa tanggal sebelum :date.',
    'before_or_equal'      => 'Masukan :attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'numeric' => 'Masukan :attribute harus antara :min dan :max.',
        'file'    => 'Masukan :attribute harus antara :min dan :max kilobytes.',
        'string'  => 'Masukan :attribute harus antara :min dan :max characters.',
        'array'   => 'Masukan :attribute harus antara :min dan :max items.',
    ],
    'boolean'              => 'Masukan :attribute harus benar atau salah.',
    'confirmed'            => 'Masukan konfirmasi :attribute tidak cocok.',
    'date'                 => 'Masukan :attribute bukan tanggal yang valid.',
    'date_format'          => 'Masukan :attribute tidak cocok dengan format :format.',
    'different'            => 'Masukan :attribute dan :other harus berbeda.',
    'digits'               => 'Masukan :attribute harus berupa :digits digit.',
    'digits_between'       => 'Masukan :attribute harus antara :min dan :max digit.',
    'dimensions'           => 'Masukan :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'             => 'Masukan :attribute memiliki nilai duplikat.',
    'email'                => 'Masukan :attribute harus berupa alamat email yang valid.',
    'exists'               => 'Masukan yang dipilih :attribute tidak valid.',
    'file'                 => 'Masukan :attribute harus berupa file.',
    'filled'               => 'Masukan :attribute tidak boleh kosong.',
    'image'                => 'Masukan :attribute harus berupa gambar.',
    'in'                   => 'Masukan yang dipilih :attribute tidak valid.',
    'in_array'             => 'Masukan :attribute tidak ada di :other.',
    'integer'              => 'Masukan :attribute harus berupa integer.',
    'ip'                   => 'Masukan :attribute harus berupa alamat IP yang valid.',
    'json'                 => 'Masukan :attribute harus berupa string JSON yang valid.',
    'max'                  => [
        'numeric' => 'Masukan :attribute tidak boleh lebih besar dari :max.',
        'file'    => 'Masukan :attribute tidak boleh lebih besar dari :max kilobytes.',
        'string'  => 'Masukan :attribute tidak boleh lebih besar dari :max characters.',
        'array'   => 'Masukan :attribute tidak boleh memiliki lebih dari :max item.',
    ],
    'mimes'                => 'Masukan :attribute harus berupa file dengan tipe: :values.',
    'mimetypes'            => 'Masukan :attribute harus berupa file dengan tipe: :values.',
    'min'                  => [
        'numeric' => 'Masukan :attribute harus setidaknya :min.',
        'file'    => 'Masukan :attribute harus setidaknya :min kilobytes.',
        'string'  => 'Masukan :attribute harus setidaknya :min characters.',
        'array'   => 'Masukan :attribute harus memiliki setidaknya :min item.',
    ],
    'not_in'               => 'Masukan yang dipilih :attribute tidak valid.',
    'numeric'              => 'Masukan :attribute harus berupa angka.',
    'present'              => 'Masukan :attribute harus ada.',
    'regex'                => 'Masukan :attribute format tidak valid.',
    'required'             => 'Masukan :attribute tidak boleh kosong.',
    'required_if'          => 'Masukan :attribute diperlukan saat :other adalah :value.',
    'required_unless'      => 'Masukan :attribute diperlukan kecuali :other ada dalam :values.',
    'required_with'        => 'Masukan :attribute diperlukan saat :values ada.',
    'required_with_all'    => 'Masukan :attribute diperlukan saat :values ada.',
    'required_without'     => 'Masukan :attribute diperlukan saat :values ada.',
    'required_without_all' => 'Masukan :attribute diperlukan bila tidak ada :values yang keluar.',
    'same'                 => 'Masukan :attribute dan :other harus sesuai.',
    'size'                 => [
        'numeric' => 'Masukan :attribute harus :size.',
        'file'    => 'Masukan :attribute harus :size kilobytes.',
        'string'  => 'Masukan :attribute harus :size karakter.',
        'array'   => 'Masukan :attribute harus berisi :size item.',
    ],
    'string'               => 'Masukan :attribute harus berupa string.',
    'timezone'             => 'Masukan :attribute harus merupakan zona yang valid.',
    'unique'               => 'Masukan :attribute sudah digunakan.',
    'uploaded'             => 'Masukan :attribute gagal diunggah.',
    'url'                  => 'Masukan :attribute format tidak valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'nama',
        'mobile' => 'no hp',
        'gender' => 'jenis kelamin',
        'dob' => 'tanggal lahir',
        'address' => 'alamat',
        'allow_newsletter' => 'izinkan berita',
        'allow_survey' => 'izinkan survei',
        'allow_promotion' => 'izinkan promosi',
        'old_password' => 'password lama',
        'new_password' => 'password baru',
        'new_password_confirmation' => 'konfirmasi password baru',
        'username' => 'email',
        'password' => 'password',
        'password_confirmation' => 'konfirmasi password',
        'g-recaptcha-response' => 'captcha',
        'email' => 'email',
        'token' => 'kode verifikasi',
        'value' => 'nilai',
    ],

];