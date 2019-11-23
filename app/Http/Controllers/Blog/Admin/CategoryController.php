<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;



class CategoryController extends BaseController
{

    /**
     * @var BlogCategoryRepository
     */

    private $blogCategoryRepository;

    public function __construct()
    {
//        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $items = BlogCategory::paginate(5);
        $items = $this->blogCategoryRepository->getAllWithPaginate(5);
        return view('blog.admin.categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox($item->parent_id);

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();


        $item = (new BlogCategory())->create($data); // Создаст и добавит

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранен']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {

        $item = $categoryRepository->getEdit($id);

        //вызов BlogCategory -> getTitleAttribute()
        $v['title_before'] = $item->title;

        $item->title = 'fghdgfhjftkfdrtsdfg asdasdasda 123213';

        $v['title_after'] = $item->title;
        $v['getAttribute'] = $item->getAttribute('title');
        $v['attributesToArray'] = $item->attributesToArray();
        $v['attributes'] = $item->attributes['title'];
        $v['getAttributeValue'] = $item->getAttributeValue('title');
        $v['getMutatedAttributes'] = $item->getMutatedAttributes();
        $v['hasGetMutator'] = $item->hasGetMutator('title');
        $v['toArray'] = $item->toArray();

        dd($v, $item);
        if (empty($item)) {
            abort(404);//если не нашли модель то 404
        }

        $categoryList = $categoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = BlogCategory::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();//чтобы данные в форме остались на месте
        }

        $data = $request->all();


        $result = $item->update($data);
        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ощибка сохранение'])
                ->withInput();
        }

    }

}
