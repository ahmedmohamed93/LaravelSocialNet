@extends('layouts.app')

@section('content')
<h1>Edit Profile</h1>



{!! Form::open(['action' => ['UserController@update', Auth::user()->id], 'method' => 'POST','enctype'=> 'multipart/form-data']) !!}  
     <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Name']) }}
     </div>
     <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email',Auth::user()->email, [ 'class' => 'form-control', 'placeholder' => 'Email']) }}
     </div>
     <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password',['class' => 'form-control', 'placeholder' => 'Type New Password If You Want']) }}
     </div>
     <div class="form-group">
        {{ Form::file('profile_image') }}
     </div>
     
     {{ Form::hidden('_method', 'PUT') }}
     
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}





@endsection