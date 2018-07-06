@extends('app')

@section('main-content')
    <div class="content-main__container">
        <div class="news-block content-text">
            <h3 class="content-text__title">
                {{ $post->title }}
            </h3><img src="/img/news/{{ $post->photo }}" alt="Image" class="alignleft img-news">
            <span style="color: cadetblue; font-size: small">{{ $post->created_at }}</span>
            <p>
                {{ $post->description }}
            </p>
        </div>
    </div>
@endsection()
