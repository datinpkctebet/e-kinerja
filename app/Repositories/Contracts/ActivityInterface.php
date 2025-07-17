<?php namespace App\Repositories\Contracts;

interface ActivityInterface
{
    public function get();

    public function create(array $param);

    public function find($id);

    public function where($column, $id);

    public function update($id, array $param);

    public function destroy($id);

    public function sumVolToday(array $param);

    public function findWithPaginate(array $param);

    public function listMonth();

    public function listYear();
}
