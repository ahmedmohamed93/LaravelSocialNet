@extends('layouts.app')

@section('content')
<a href="{{ url('/dashboard') }}" class="btn btn-default">Back</a>
<h1 class="text-center">My Profile</h1>
<div class="well">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <img src='{{url("/storage/profile_images/".$user->profile_image)}}' style="width:400px;height:500px; border-radius:5%">
        </div>
        <div class="col-md-8 col-sm-8">
                <div class="container">
                    
                            <ul class="list-unstyled" style="margin:50px;">
                                <li>
                                    <h2 style="font-size:20px; display:inline-block">
                                        <span style="font-size:25px"> Name : </span> 
                                         {{$user->name}}
                                    </h2>
                                </li>
                                <li>
                                    <h2 style="font-size:20px; display:inline-block">
                                        <span style="font-size:25px"> Email : </span>
                                          {{$user->email}}
                                    </h2>
                                </li>
                                
                            </ul>
                            @if(Auth::user()->id == $user->id)
                            <a style="margin: 15px 0 0 50px" href='{{url("/user/".Auth::user()->id."/edit")}}' class="btn btn-default">Edit Profile</a>
                            @endif
                        
                
                
                </div>
        </div>
    </div>                
</div>








@endsection