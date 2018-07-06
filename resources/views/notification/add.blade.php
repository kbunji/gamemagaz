@extends('admin.app')

@section('main-content')
    <h3>Добавить получателя</h3>
    <form action="{{ route('notification.store') }}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   placeholder="email" required>
            @if ($errors->has('email'))
                <span style="color: red" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mb-2">Добавить</button>
    </form>
@endsection