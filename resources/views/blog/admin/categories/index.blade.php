@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="navbar navbar-toggleable-md navbar-light bg-faded">
            <div class="col-md-12">
                <nav>
                    <a class="btn btn-primary" href="{{ route('blog.admin.categories.create') }}"> Добавить </a>
                </nav>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Категория</th>
                            <th>Родитель</th>
                        </tr>
                    <tbody>
                    @foreach($items as $item)
                        @php /** @var \App\Models\BlogCategory $item */ @endphp
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <a href="{{ route('blog.admin.categories.edit' , $item->id) }}">
                                    {{ $item->title }}
                                </a>
                            </td>
                            <td @if( in_array($item->paremnt_id, [0,1])) style="color:#ccc" @endif>
                                {{ $item->parent_id }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($items->total() > $items->count())
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
