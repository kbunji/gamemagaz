@extends('admin.app')

@section('main-content')
    <td><a href="{{route('order.all')}}"
           class="sidebar-category__item__link">Все заказы</a></td>
    <h3>Детали заказа</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Продукт</th>
            <th scope="col">Количетсво</th>
            <th scope="col">Цена за единицу</th>
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
@endsection