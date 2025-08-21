<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Models\Holiday;
use Grei\TanggalMerah;
use Illuminate\Support\Facades\DB;

class HolidayRepository extends AbstractRepository
{
    public function __construct(Holiday $holiday)
    {
        $this->model = $holiday;
    }

    public function findWithPaginate(array $param)
    {
        $perpage = $param['perpage'] ?? 10;

        $data = Holiday::orderBy('holidays.created_at', 'DESC');

        $data = $data->paginate($perpage);

        return $data;
    }

    /**
     * Sinkronisasi data tanggal merah/libur nasional dari API guangrei
     * ke tabel holidays.
     */
    public function sync()
    {
        $tanggalMerah = new TanggalMerah(); // otomatis ambil dari API github
        $dataLibur = $tanggalMerah->getAll();   // ambil seluruh data holidays.json

        $existingData = Holiday::withTrashed()->orderBy('holidays.date', 'DESC')->get(); // ambil data yang sudah ada
        $existingData = $existingData->toArray(); // konversi ke array untuk manipulasi
        $existingData = array_column($existingData, 'date', 'date'); // ubah menjadi associative array dengan 'date' sebagai key

        DB::beginTransaction();
        try {
            foreach ($dataLibur as $date => $info) {
                // lewati key info tambahan dari API (misalnya 'info')
                if ($date === 'info') {
                    continue;
                }

                if (isset($existingData[$date])) {
                    // Jika data sudah ada → update deleted_at = NULL + update description
                    Holiday::withTrashed()
                        ->where('date', $date)
                        ->update([
                            'description' => $info['summary'] ?? 'Libur Nasional',
                            'deleted_at'  => null, // restore manual
                    ]);
                } else {
                    // Jika data belum ada → buat baru
                    Holiday::create([
                        'date'        => $date,
                        'description' => $info['summary'] ?? 'Libur Nasional',
                        'deleted_at'  => null,
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

