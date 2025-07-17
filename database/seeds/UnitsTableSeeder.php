<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            ['title' => 'Kapuskes Kebon Baru'],
            ['title' => 'Kapuskes Tebet Barat'],
            ['title' => 'Kapuskes Menteng Dalam'],
            ['title' => 'Kapuskes Bukit Duri'],
            ['title' => 'Kapuskes Manggarai Selatan'],
            ['title' => 'Kapuskes Manggarai'],
            ['title' => 'Kasatpelukp'],
            ['title' => 'Kasatpelukm'],
            ['title' => 'Kepala Tata Usaha'],
            ['title' => 'Rumah Bersalin'],
            ['title' => 'Layanan 24 Jam'],
        ];

        if (DB::table('units')->get()->count() == 0) {
            DB::table('units')->insert($units);
        } else {
            echo "Table units is not empty, seeder fail!";
        }
    }
}
