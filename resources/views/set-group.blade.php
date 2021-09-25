@extends('layouts.base')

@section('content')
<form action="{{ route('addUserForm', ['group_id'=>$group->id]) }}" method="post">
    @csrf
    <select name="user_id" id="user_id" placeholder="Выберите пользователя" required>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->id }} {{ $user->name }}</option>
        @endforeach
    </select>
    <button type="submit">Добавить</button>
</form>
<a href="{{ URL::previous() }}">Назад</a>
@endsection
