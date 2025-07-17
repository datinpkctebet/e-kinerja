<?php namespace App\Repositories\Contracts;

interface KarirInterface
{
    public function get();

    public function create(array $param);

    public function find($id);

    public function where($column, $id);

    public function update($id, array $param);

    public function destroy($id);

    public function findWithPaginate(array $param);
}
