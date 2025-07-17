<?php namespace App\Repositories;

use App\Repositories\AbstractRepository;

use App\Models\Question;

class QuestionRepository extends AbstractRepository
{
    public function __construct(Question $question)
    {
        $this->model = $question;
    }

    /**
    * Create category list
    *
    * @return Object
    */
    public function category()
    {
        return [
            'Berorientasi Pelayanan' => 'Berorientasi Pelayanan',
            'Akuntabel' => 'Akuntabel',
            'Kompeten' => 'Kompeten',
            'Harmonis' => 'Harmonis',
            'Loyal' => 'Loyal',
            'Adaptif' => 'Adaptif',
            'Kolaboratif' => 'Kolaboratif',
        ];
    }
}