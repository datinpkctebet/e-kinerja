<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;

use App\Models\Variable;

class VariableRepository extends AbstractRepository
{
    public function __construct(Variable $variable)
    {
        $this->model = $variable;
    }
}