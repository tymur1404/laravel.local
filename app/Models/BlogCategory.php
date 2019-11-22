<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @package App\Models
 * 
 * для подсказок когда наводишь курсором
 *
 * @property-read BlogCategory $parentCategory
 * @property-read string $parentTitle
 *
 */


class BlogCategory extends Model
{
    use SoftDeletes;

    const ROOT = false;

    // определяеи поля для редактироввния
    protected $fillable = [

        'title',
        'slug',
        'parent_id',
        'description',
    ];

    public function parentCategory()
    {
        //Связываем BlogCategories.parent_id c id
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    // кастомный аттрибут. Вызывается во view parent_title или parentTitle
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
                ? 'Корень'
                : '???');

        return $title;
    }

    public function isRoot(){
        return $this->id === BlogCategory::ROOT;
    }
}
