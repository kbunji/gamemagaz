@extends('admin.app')

@section('main-content')
    <h3>Заказы</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">№ заказа</th>
            <th scope="col">Имя клиента</th>
            <th scope="col">Email</th>
            <th scope="col">Комментарии</th>
            <th scope="col">Дата поступления</th>
            <th scope="col">Детали заказа</th>
        </tr>
        </thead>
        <tbody>
        @foreach($adminOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->comments }}</td>
                <td>{{ $order->updated_at }}</td>
                <td><a href="{{route('order.details', ['orderId' => $order->id])}}"
                       class="sidebar-category__item__link">Подробнее</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection