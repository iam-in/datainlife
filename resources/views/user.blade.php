<div>
    <strong>{{ $user->name }}</strong>
    <hr>
</div>
<p>Группы:</p>

<ul>
@foreach ($user->groups as $group)
    
        <li>
            <a href="{{ route('group', ['group_id'=>$group->id]) }}">
                №{{ $group->id }} {{ $group->name }} {{ $group->expire_hourse }}ч.
            </a> 
            (доступ до {{ $group->pivot->expired_at }})
        </li>
    
@endforeach
</ul>

<a href="{{ URL::previous() }}">Назад</a>
<a href="{{ route('users') }}">Все пользователи</a>
<a href="{{ route('groups') }}">Все группы</a>