@extends('app')
@section('title')
    Новости
@endsection
@section('main-content')
    <div class="content-main__container">
            <div class="news-block content-text">
                @foreach($posts as $post)
                    <div class="post" style="height: 201px;">
                        <h3 class="content-text__title">
                            {{ $post->title }}
                        </h3>
                        <img src="/img/news/{{ $post->photo }}" width="150" height="150" alt="Image" class="alignleft img-news">
                        <p style="color: cadetblue; font-size: small">{{ $post->created_at }}</p>
                        <a href="{{route('post.get', ['post_id' => $post->id])}}">Подробнее</a>
                    </div>
                @endforeach
            </div>
    </div>
@endsection()
