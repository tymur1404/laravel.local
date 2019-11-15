<?php
/**
 * Created by PhpStorm.
 * User: timur
 * Date: 01.11.19
 * Time: 15:27
 */

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass()
    {

        return Model::class;
    }

    public function getEdit($id)
    {

        return $this->startConditions()->find($id);
    }

    public function getForComboBox()
    {
        $columns = implode(', ', ['id', 'CONCAT (id, ". ", title) AS id_title']);

        $result[] = $this
            ->startConditions()
            ->select($columns)//не нужно агрегировать полученные данные в объекты класса BaseCategory и будет просто stdClass. Без этого будет коллекция BlogCategory
            ->toBase()
            ->get();

        return($result);
    }


    public function getAllWithPaginate($perPage = null){
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            /* */
            ->paginate($perPage);

        return $result;
    }
}
