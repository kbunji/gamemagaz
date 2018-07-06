<h3>Клиент {{ $emailClient }}</h3>
<h3>Активный заказ №{{ $orderId }}</h3>
<p>Детали заказа</p>
<table border="1" class="table">
    <thead>
    <tr>
        <th scope="col">Продукт</th>
        <th scope="col">Количество</th>
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