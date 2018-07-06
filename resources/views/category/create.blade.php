@extends('admin.app')

@section('main-content')
    <h3>Создать категорию</h3>
    <form action="{{ route('category.store') }}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="Название">
            @if ($errors->has('name'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
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