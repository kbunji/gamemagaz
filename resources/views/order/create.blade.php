@extends('app')
@extends ('web.index')

@section('order-form')
    <div class="popup" id="myPopup">
        <form method="POST" class="popup-form" action="{{ route('order.store') }}" aria-label="{{ __('Register') }}">
            <h3>Оформление заказа</h3>
            <p>Вы выбрали продукт {{ $prod->name }}</p>
            <p>Подробные детали в "Моих заказах"</p>
            @csrf
            <input id="productId" name="productId" type="hidden" value="{{ $prod->id }}">
            <div class="form-group row">
                <label for="name"
                       class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ old('name') }}" required>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="email"
                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Адрес') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
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
            <div class="form-group">
                <label for="comments">Комментарии</label>
                <textarea class="form-control" id="comments" name="comments"
                          rows="3"></textarea>
                @if ($errors->has('comments'))
                    <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Новый заказ') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
