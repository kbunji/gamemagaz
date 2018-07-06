@extends('admin.app')

@section('main-content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" class="form-control" id="title" name="title"
                   placeholder="Название" required>
            @if ($errors->has('title'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group">
            <label for="photo">Выберите картинку новости</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            @if ($errors->has('photo'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description"
                      rows="3"></textarea>
            @if ($errors->has('description'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mb-2">Создать</button>
    </form>
@endsection