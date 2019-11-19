<?php
/**
 * Created by PhpStorm.
 * User: timur
 * Date: 01.11.19
 * Time: 15:27
 */

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate()
    {

        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with(['category:id,title', 'user:id,name'])//для lazy load(жадной загрузки). Указать в модели "return $this->belongsTo()" выбрали по два поля из каждой таблицы
            ->paginate(25);
//        ->get();


        return $result;
    }

    public function getEdit($id)
    {

        return $this->startConditions()->find($id);
    }

    public function getForComboBox()
    {
        $columns = ['id', 'title'];

        $result = $this
            ->startConditions()
            ->select($columns)//не нужно агрегировать полученные данные в объекты класса BaseCategory и будет просто stdClass. Без этого будет коллекция BlogCategory
            ->toBase()
            ->get();

        return($result);
    }
}
