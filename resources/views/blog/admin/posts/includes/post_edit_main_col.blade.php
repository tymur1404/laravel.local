@php
/** @var \App\Models\BlogPost $item */
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
                <div class="card-body">
                    <div class="card-title"></div>
                    <div class="card-subtitle mb-2 text-muted"></div>
                    <ul class="nav van-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toogle="tab" href="#maindata" role="tab">Основные данные</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toogle="tab"  href="#adddata" role="tab">Доп категорий</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane active" id="maindata" role="tabpanel">
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input name ='title' value="{{ $item->title }}"
                                       id="title"
                                       type="text"
                                       class="form-control"
                                       minlength="3"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="content_raw">Статья</label>
                                <textarea name="content_raw"
                                       id="content_raw"
                                       rows="20"
                                          class="form-control">{{ old('content_raw', $item->content_raw) }} </textarea>
                            </div>
                        </div>
                        <div class="tab-pane active" id="adddata" role="tabpanel">
                            <div class="tab-pane active" id="maindata" role="tabpanel">
                                <div class="form-group">
                                    <label for="category_id">Категория</label>
                                    <select name="category_id"
                                            id="category_id"
                                            class="form-control"
                                            placeholder="Выберете категорию"
                                            required>
                                            @foreach($categoryList as $categoryOption)
                                                <option value="{{ $categoryOption->id }}"
                                                @if($categoryOption->id == $item->category_id) selected @endif>
                                                    {{ $categoryOption->id_title }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Индетификатор</label>
                                    <input name="slug" value="{{ $item->slug }}"
                                           id="slug"
                                           type="text"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="excerpt">Выдержка</label>
                                    <textarea name="excerpt"
                                                id="excerpt"
                                                class="form-control"
                                                row="3">
                                        {{ old('excerpt', $item->exceprt) }}
                                    </textarea>
                                </div>

                                <div class="form-check">
                                    <input name="is_published"
                                            type="hidden"
                                            value="0">
                                    <input name="is_publised"
                                            type="checkbox"
                                            class="form-check-input"
                                            value="{{ $item->is_published }}"
                                            @if($item->is_published)
                                                checked="checked"
                                            @endif>
                                    <label class="form-check-label" for="is_published">Опубликовано</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>