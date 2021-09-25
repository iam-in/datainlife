@extends('layouts.base')

@section('content')
<ul>
    @foreach ($groups as $group)
        <a href="{{ route('group', ['group_id'=>$group->id]) }}">
            <li>№{{ $group->id }} {{ $group->name }}. Истекает через - {{ $group->expire_hourse }} ч.</li>
        </a>
    @endforeach
</ul>
@endsection