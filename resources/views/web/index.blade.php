@extends('app')
@section('title')
    Последние товары
@endsection
@section('main-content')
    <div class="content-main__container">
        <div class="products-columns">
            @foreach($products as $product)
                <div class="products-columns__item">
                    <div class="products-columns__item__title-product">
                        <a href="/product/get/{{ $product->id }}" class="products-columns__item__title-product__link">
                            {{ $product->name }}
                        </a>
                    </div>
                    <div class="products-columns__item__thumbnail">
                        <a href="{{route('product.get', ['product_id' => $product->id])}}"
                           class="products-columns__item__thumbnail__link">
                            <img src="/img/cover/{{ $product->photo }}" alt="Preview-image"
                                 class="products-columns__item__thumbnail__img">
                        </a>
                    </div>
                    <div class="products-columns__item__description">
                        <span class="products-price">{{ $product->price }} руб</span>
                        <a href="{{route('order.manager', ['productId' => $product->id])}}"
                           class="btn btn-blue">Купить</a>
                    </div>
                </div>
            @endforeach
            <div class="content-footer__container">
                {{ $products->links('paginate.paginate') }}
            </div>
        </div>
    </div>
@endsection()
