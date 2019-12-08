@extends('layouts.app')

@section('title', 'User details')

@section('content')

<p>The users of volunteering opportunities:</p>

<ul>
    <li>Name: {{ $user->name }}</li>
    <li>Email: {{ $user->email }}</li>
    <li>Country: {{ $user->country }}</li>
</ul>

@endsection