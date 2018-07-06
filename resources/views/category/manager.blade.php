@extends('admin.app')

@section('main-content')
    <p class="nav-list__item"><a href="{{ route('category.create') }}"
                                  class="nav-list__item__link">Создать новую категорию</a></p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td><a href="{{route('category.edit', ['$category_id' => $category->id])}}"
                       class="sidebar-category__item__link">Изменить</a></td>
                <td><a href="{{route('category.delete', ['$category_id' => $category->id])}}"
                       class="sidebar-category__item__link">Удалить</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection