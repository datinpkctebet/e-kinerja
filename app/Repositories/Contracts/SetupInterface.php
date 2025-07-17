<?php namespace App\Repositories\Contracts;

interface SetupInterface
{
    public function getAttention($column);

    public function updateAttention($id, array $param);

    public function get();

    public function create(array $param);

    public function find($id);

    public function where($column, $id);

    public function update($id, array $param);

    public function destroy($id);
}
