<head>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<div>
    <strong>{{ $group->name }} {{ $group->expire_hourse }}ч.</strong>
    <hr>
    @if (Session::has('message'))
        <div class="success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div>
    <a href="{{ route('addUser', ['group_id'=>$group->id]) }}">Добавить пользователя в группу</a>
</div>
</div>
<p>Участники группы:</p>

<ul>
@foreach ($group->users as $user)
    <a href="{{ route('user', ['user_id'=>$user->id]) }}">
        <li>{{ $user->id }} {{ $user->name }}</li>
    </a>
@endforeach
</ul>


<a href="{{ URL::previous() }}">Назад</a>
<a href="{{ route('users') }}">Все пользователи</a>
<a href="{{ route('groups') }}">Все группы</a>