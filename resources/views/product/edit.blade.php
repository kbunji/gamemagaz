@extends('admin.app')

@section('main-content')
    <h3>Изменить продукт {{ $product->name }}</h3>
    <form action="{{ route('product.update', ['productId' => $product->id]) }}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="category_id">Изменить категорию товаров</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="{{ $product->category_id }}">Не изменять</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}"
                   placeholder="Название">
            @if ($errors->has('name'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="number" class="form-control" id="price" name="price"
                   placeholder="Цена товара" value="{{ $product->price }}" required>
            @if ($errors->has('number'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group">
            <label for="photo">Изменить картинку товара</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" name="description"
                      rows="3">{{ $product->description }}</textarea>
            @if ($errors->has('description'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mb-2">Изменить</button>
    </form>
@endsection