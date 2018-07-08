@extends('admin.app')
@section('admin-title')
    Управление товарами
@endsection
@section('main-content')

    <div class="nav-list__item"><a href="{{ route('product.create') }}"
                                   class="nav-list__item__link">Создать новый товар</a></div>

    <form action="{{ route('products.all') }}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="categoryId">Выберите категорию товаров</label>
            <select id="category-show" name="categoryId" class="form-control" id="categoryId">
                <option value="0">Все</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Показать</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Фото</th>
            <th scope="col">Описание</th>
            <th scope="col">Создан</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <img src="/img/cover/{{ $product->photo }}" alt="Preview-image"
                         class="products-columns__item__thumbnail__img"
                         style="max-width: 150px">
                </td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->created_at }}</td>
                <td><a href="{{route('product.edit', ['productId' => $product->id])}}"
                       class="sidebar-category__item__link">Изменить</a>
                    <a href="{{route('product.delete', ['$productId' => $product->id])}}"
                       class="sidebar-category__item__link">Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection