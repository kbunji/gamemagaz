@extends('app')
@section('title')
    Мой заказ
@endsection
@section('main-content')
    @if (isset($orderActive))
        <div class="nav-list__item"><a href="{{ route('order.close', ['orderId' => $orderActive->id]) }}"
                                       class="nav-list__item__link">Завершить заказ</a></div>
        <h3>Активный заказ №{{ $orderActive->id }}</h3>
        <p>Детали заказа</p>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Продукт</th>
                <th scope="col">Количество</th>
                <th scope="col">Цена за единицу</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3>У вас нет активных заказов</h3>
    @endif
@endsection