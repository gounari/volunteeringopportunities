@extends('layouts.app')

@section('title', 'Users')

@section('content')

<p>The users of volunteering opportunities:</p>

<ul>
    @foreach ($users as $user)
    <li><a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a></li>
    @endforeach
</ul>

@endsection