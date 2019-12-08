@extends('layouts.app')

@section('title', 'Users')

@section('content')

<p>The users of volunteering opportunities:</p>

<ul>
    @foreach ($users as $user)
    <li>{{ $user->name }}</li>
    @endforeach
</ul>

@endsection