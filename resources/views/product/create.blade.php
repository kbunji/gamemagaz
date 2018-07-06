@extends('admin.app')

@section('main-content')
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="categoryId">Выберите категорию товаров</label>
            <select id="category-show" name="categoryId" class="form-control" id="categoryId">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="Название" required>
            @if ($errors->has('name'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="number" class="form-control" id="price" name="price"
                   placeholder="Цена товара" required>
            @if ($errors->has('number'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group">
            <label for="photo">Выберите картинку товара</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
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