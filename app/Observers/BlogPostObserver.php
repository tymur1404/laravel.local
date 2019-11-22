<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{
    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

        $this->setHtml($blogPost);

        $this->setUser($blogPost);

    }

    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //dd('updated observer', $blogPost);
    }

    /**
     * Обработка ПЕРЕД обновлением записи
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */

    public function updating(BlogPost $blogPost)
    {
//        $test[] = $blogPost->isDirty();  //изменялась или нет. Если да true
//        $test[] = $blogPost->isDirty('is_published'); //изменялось ли поле is_published
//        $test[] = $blogPost->isDirty('user_id'); //изменялось ли поле user_id
//        $test[] = $blogPost->getAttribute('is_published'); // получаем значение уже измененного атрибута
//        $test[] = $blogPost->is_published; //Тоже самое  получаем значение уже измененного атрибута
//        $test[] = $blogPost->getOriginal('is_published'); // старое значение
//        dd($test);

        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);

        // return false; // если не правильный результат
    }



    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }

    protected function setPublishedAt(BlogPost $blogPost)
    {
        $needSetPublished = empty($blogPost->published_at) && $blogPost->is_published;

        if($needSetPublished){
            $blogPost->published_at = Carbon::now();
        }
    }

    protected function setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost->slug)){
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }

    protected function setHtml(BlogPost $blogPost)
    {
        if($blogPost->isDirty('content_raw')){
            // TODO: тут должна быть генерация markdown -> html
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }
}
