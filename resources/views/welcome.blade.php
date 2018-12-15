@extends('layout')

@section('title', 'Home')
@section('header', 'Home Page')

@section('content')
    <div class="container">
        @foreach ($tasks as $task)
            <ui>
                <li> <a href="{{$task}}">{{$task}}</a> </li>
            </ui>
        @endforeach
    </div>
@endsection
