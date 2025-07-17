<?php namespace App\Repositories\Contracts;

interface QuestionInterface
{
    public function get();

    public function category();

    public function create(array $param);

    public function find($id);

    public function update($id, array $param);

    public function destroy($id);
}