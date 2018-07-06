@extends('app')
@extends ('web.index')

@section('order-form')
    <div class="popup" id="myPopup">
        <form method="POST" class="popup-form" action="{{ route('order.add') }}">
        <h3>Добавить к заказу #{{ $order->id }}</h3>
        <p>Продукт {{ $prod->name }}</p>
        <p>Подробные детали в "Моих заказах"</p>
        @csrf
        <input id="productId" name="productId" type="hidden" value="{{ $prod->id }}">
        <input id="orderId" name="orderId" type="hidden" value="{{ $order->id }}">
        <div class="form-group row">
            <label for="quantity"
                   class="col-md-4 col-form-label text-md-right">Количество</label>

            <div class="col-md-6">
                <input id="quantity" type="number"
                       class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                       name="quantity" required>

                @if ($errors->has('quantity'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Добавить
                </button>
            </div>
        </div>
        </form>
    </div>
@endsection
