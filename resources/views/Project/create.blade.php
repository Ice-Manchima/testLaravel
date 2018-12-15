@extends('layout')


@section('title', 'About')
@section('header', 'All Project')

@section('content')

    <form method="POST" action="/Project">
        {{ csrf_field() }}
        <div>
            <input type="text" name="title" placeholder="Title">
        </div>
        <div>
            <textarea name="description" placeholder="Description"></textarea>
        </div>
        <div>
            <button type="submit">Save</button>
        </div>
    </form>
@endsection
