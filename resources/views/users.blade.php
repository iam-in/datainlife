@extends('layouts.base')

@section('content')
<ul>
    @foreach ($users as $user)
        <a href="{{ route('user', ['user_id'=>$user->id]) }}">
            <li>{{ $user->id }} {{ $user->name }}</li>
        </a>
    @endforeach
</ul>
@endsection