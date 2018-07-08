@extends('admin.app')
@section('admin-title')
    Управление новостями
@endsection
@section('main-content')
    <li class="nav-list__item"><a href="{{ route('post.create') }}"
                                  class="nav-list__item__link">Создать новость</a></li>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
            <th scope="col">Фото</th>
            <th scope="col">Создан</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>
                    <img src="/img/news/{{ $post->photo }}" alt="Preview-image"
                         class="products-columns__item__thumbnail__img"
                         style="max-width: 150px">
                </td>
                <td>{{ $post->created_at }}</td>
                <td><a href="{{route('post.edit', ['postId' => $post->id])}}"
                       class="sidebar-category__item__link">Изменить</a>
                    <a href="{{route('post.delete', ['$post' => $post->id])}}"
                       class="sidebar-category__item__link">Удалить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection