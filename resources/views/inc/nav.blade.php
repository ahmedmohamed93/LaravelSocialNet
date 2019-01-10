<nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">{{config('app.name', 'LSAPP')}}</a>
    
            </div>         
                
          
                <div class="collapse navbar-collapse" id="navbarsExample02">
                  <ul class="navbar-nav mr-auto">
                    <li><a class="nav-link" href="{{ url('/') }}">Home </a></li>
                    <li><a class="nav-link" href="{{ url('/about') }}">About </a></li>
                    <li><a class="nav-link" href="{{ url('/services') }}">Services </a></li>
                    <li><a class="nav-link" href="{{ url('/posts') }}">Blog </a></li>
                  </ul>
    
                  <ul class="nav navbar-nav navbar-right">
                      <a href="{{url('/posts/create')}}">Create Post</a>
                  </ul>
                </div>
        </div>
            
    </nav>