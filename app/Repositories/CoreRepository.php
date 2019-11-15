<?php
/**
 * Class CoreRepository
 * @package App\Repositories
 * репозитории работы с сущностью
 * Может выдавать наборы данных
 * Не может создавать/изменять сущности
 *
 */

namespace App\Repositories;


abstract class CoreRepository
{
    /**
     * @var Model
     */

    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();


    /**
     * @return Model|\Illuminate\Foundation\Application|mixed
     */

    protected function startConditions()
    {
        return clone $this->model;
    }

}
