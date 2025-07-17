<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;
use App\Repositories\Contracts\SetupInterface;

use App\Models\Setup;

class SetupRepository extends AbstractRepository implements SetupInterface
{
    public function __construct(Setup $setup)
    {
        $this->model = $setup;
    }

    /**
    * Get own attention by privilege
    *
    * @return Object
    */
    public function getAttention($privilege)
    {
        return $this->model->where('type', $privilege)->first();
    }


    /**
    * Update attention by admin for employee only
    *
    */
    public function updateAttention($type, $data)
    {
        $query = $this->model->where('type', $type)->first();;

        $query->update($data);
    }

    /**
    * Get data from setup
    * Type Header Cuti
    * Type Atasan
    * Type Pejabat Berwenang
    *
    * @return Object
    */
    public function formCuti()
    {
        return $this->model
                    ->orwhere('type', 'Atasan')
                    ->orwhere('type', 'Atasan1')
                    ->orWhere('type', 'Pejabat Berwenang')
                    ->get();
    }

    /**
    * Set Type form surat pemberian cuti
    *
    * @return Object
    */
    public function formCutiType()
    {
        return [
            'Atasan',
            'Atasan1',
            'Pejabat Berwenang',
        ];
    }

    /**
    * Set Type form surat pemberian cuti
    *
    * @param $type
    * @return Object
    */
    public function getByType($type)
    {
        return $this->model
                    ->where('type', $type)
                    ->get();
    }
}
