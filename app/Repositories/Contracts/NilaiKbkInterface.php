<?php namespace App\Repositories\Contracts;

interface NilaiKbkInterface
{
    public function get();

    public function create(array $param);

    public function findWithPaginate(array $param);
}
