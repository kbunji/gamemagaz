@extends('admin.app')

@section('main-content')
    <h3>Изменить продукт {{ $post->title }}</h3>
    <form action="{{ route('post.update', ['postId' => $post->id]) }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}"
                   placeholder="Название">
            @if ($errors->has('title'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group">
            <label for="photo">Изменить картинку новости</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description"
                      rows="3">{{ $post->description }}</textarea>
            @if ($errors->has('description'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mb-2">Изменить</button>
    </form>
@endsection