@extends('layout')


@section('title', 'About')
@section('header', 'All Project')

@section('content')
    <a href="/Project/create" class="btn-dark" >Create Project</a>
    <div class="container">
        <table border = '0'>
            <tr>
                <td>Title</td>
                <td>Description</td>
            </tr>
        @foreach($projects as $project)
            <tr>
                <td>{{$project->title}}</td>
                <td>{{$project->description}}</td>
            </tr>
        @endforeach
        </table>
    </div>
@endsection
