@extends('layouts.app')

@section('content')
<a href="{{ url('/posts') }}" class="btn btn-default">Back</a>
<h1>{{$post->title}}</h1>
<img style="width:30%" src='{{url("/storage/cover_images/$post->cover_image")}}' >

<div>{{$post->body}}</div>

<hr style="color:black">
<small>Written On {{$post->created_at}} By <a  href='{{url("/user/$post->user_id")}}' style="text-decoration:none">{{$post->user->name}}</a></small>
<hr style="color:black">
@if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id)
        <a href='{{url("posts/$post->id/edit")}}' class="btn btn-primary">Edit</a>


        {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class'=> 'pull-right']) !!}  
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
    @endif
@endif





@endsection