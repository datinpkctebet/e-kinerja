<?php

use Illuminate\Database\Seeder;

class SetupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setups = [
            [
                'title' => 'Halaman Admin',
                'description' => '<h2>Selamat Datang di e-Kinerja</h2>
                <p>Pada halaman ini Anda dapat melakukan beberapa hal sebagai berikut :</p>
                <ol>
                <li>Membuat sebuah berita.</li>
                <li>Melihat Profil Pegawai dan membuat akun pegawai baru.</li>
                <li>Mengatur variabel terkait.</li>
                <li>Membuat Pertanyaan.</li>
                <li>Membuat Profesi dan Tupoksi.</li>
                </ol>',
                'type' => 'Administrator',
            ],
            [
                'title' => 'Halaman Kapuskes',
                'description' => '<h2>Selamat Datang di e-Kinerja</h2>
                <p>Pada halaman ini Anda dapat melakukan beberapa hal sebagai berikut :</p>
                <ol>
                <li>Melihat kegiatan pegawai</li>
                <li>Melakukan validasi pekerjaan pegawai</li>
                <li>Memberikan penilaian terhadap pegawai</li>
                <li>Melihat rekap TKD pegawai</li>
                </ol>',
                'type' => 'Kapuskesmas',
            ],
            [
                'title' => 'Halaman Absensi',
                'description' => '<h2>Selamat Datang di e-Kinerja</h2>
                <p>Pada halaman ini Anda dapat melakukan beberapa hal sebagai berikut :</p>
                <ol>
                <li>Menginput data absensi karyawan.</li>
                <li>Mengubah data absensi karyawan.</li>
                <li>Melihat data absensi karyawan.</li>
                </ol>',
                'type' => 'Absensi',
            ],
            [
                'title' => 'Halaman Pegawai',
                'description' => '<h2>Selamat Datang di e-Kinerja</h2>
                <p>Pada halaman ini Anda dapat melakukan beberapa hal sebagai berikut :</p>
                <ol>
                <li>Melihat rekap absensi</li>
                <li>Menginput kegiatan sehari-hari</li>
                <li>Melihat rekap TKD</li>
                </ol>',
                'type' => 'Pegawai',
            ],
        ];

        if (DB::table('setups')->get()->count() == 0) {
            DB::table('setups')->insert($setups);
        } else {
            echo "Table setups is not empty, seeder fail!";
        }
    }
}
