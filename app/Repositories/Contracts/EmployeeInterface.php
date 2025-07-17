<?php namespace App\Repositories\Contracts;

interface EmployeeInterface
{
    public function get();

    public function create(array $param);

    public function find($id);

    public function getFirst($employee_id);

    public function where($column, $id);

    public function update($id, array $param);

    public function destroy($id);
}