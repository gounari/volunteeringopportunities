@extends('layouts.app')

@section('title', 'Create post')

@section('content')
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <p>Title: <input type="text" name="title" value="{{ old('title') }}"></p>
    <p>Country: <input type="text" name="country" value="{{ old('country') }}"></p>
    <p>Start Date: <input type="text" name="start_date" value="{{ old('start_date') }}"></p>
    <p>End Date: <input type="text" name="end_date" value="{{ old('end_date') }}"></p>
    <p>Description: <input type="text" name="description" value="{{ old('description') }}"></p>
    <p>Apply: <input type="text" name="application_url" value="{{ old('application_url') }}"></p>
    <p>Organization: 
        <select name="organization_id">
            @foreach ($organizations as $organization)
            <option value="{{ $organization }}">
                {{ $organization }}
            </option>>
            @endforeach
        </select>
    </p>

    <input type="submit" name="Submit">
    <a href="{{ route('posts.index') }}">Cancel</a>
</form>

@endsection