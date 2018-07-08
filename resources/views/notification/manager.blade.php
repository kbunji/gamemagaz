@extends('admin.app')
@section('admin-title')
    Управление уведомлениями
@endsection
@section('main-content')
    <p class="nav-list__item"><a href="{{ route('notification.add') }}"
                                 class="nav-list__item__link">Добавить получателя</a></p>
    <h3>Получатели уведомлений о новых заказах</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">email</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->email }}</td>
                <td><a href="{{route('notification.delete', ['$notificationId' => $notification->id])}}"
                       class="sidebar-category__item__link">Удалить</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection