@extends('layouts.app')

@section('content')
<h1>Posts</h1>
@if(count($posts) > 0)
    @foreach($posts as $post)
      <div class="well">
          <div class="row">
              <div class="col-md-4 col-sm-4">
                      <img style="width:80%" src="storage/cover_images/{{$post->cover_image}}" >
                  </div>
                  <div class="col-md-8 col-sm-8">
                      <h3><a style="text-decoration:none" href="posts/{{$post->id}}">{{$post->title}}</a></h3>
                      <small>Written On {{$post->created_at}} By <a  href='{{url("/user/$post->user_id")}}' style="text-decoration:none">{{$post->user->name}}</a> </small>
              </div>
          </div>                
      </div>
    @endforeach 
@else
 <p>You Have No Posts</p> 
@endif
@endsection