<?php namespace App\Repositories\Contracts;

interface SuratPengajuanInterface
{
    public function get();

    public function create(array $param);

    public function find($id);

    public function update($id, array $param);

    public function destroy($id);
}
