@extends('layouts.app')

<style>
  .avatar{
      border-radius: 100%;
      max-width: 100px;
}
  .nav li>a {
    color: #3490dc;
    padding-right: 0.5rem;
    padding-left: 0.5rem;
}
.nav li>a:hover {
    background-color: #a7ffff;
}
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @if(count($errors) >0 )
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">{{$error}}</div> 
               @endforeach
           @endif
            
           @if (session('response'))
                <div class="alert alert-success">
                    {{ session('response') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div class="col-md-4">
                   @if(!is_null(Auth::user()->profile))    
                   <img src="/storage/uploads/{{$profile->profile_pic}}" alt="" class="avatar"> 
                   <p class="lead">{{$profile->name}}</p>
                   <p >{{$profile->designation}}</p>
                   @else 
                   <img src="{{asset('index.png')}}" alt="" class="avatar"> 
                   <p class="lead">John Doe</p>
                   <p >No designation</p>
                   @endif
                   
                   </div>
                   <div class="col-md-8">
                       @if ((count($post) > 0 ))
                        @foreach ($post->all () as $post)
                        <h3 class="text-center">{{$post->post_title}}</h3>
                        <img src="/storage/posts/images/{{$post->post_image}}" class="img-fluid image-post">
                        <p>{{substr($post->post_body, 0, 150)}}</p>
                        

                         <ul class="nav nav-pills">
                            <li role="presentation">
                                    <a href='{{url("/view/{$post->id}")}}'>
                                    <span class="fa fa-eye"> VIEW</span>
                                </a>
                            </li>
                            <li role="presentation">
                                    <a href='{{url("/edit/{$post->id}")}}'>
                                        <span class="fa fa-pencil-square-o"> EDIT</span>
                                    </a>
                                </li>
                                <li role="presentation">
                                        <a href='{{url("/delete/{$post->id}")}}'>
                                            <span class="fa fa-trash"> DELETE</span>
                                        </a>
                                    </li>
                         </ul>
          

                        <cite style="float:left;">Posted on:{{date('M d, Y  h:i', strtotime($post->updated_at))}}</cite>
                        <hr>
                        @endforeach
                           
                       @else
                           <p>No Post Available!</p>
                       @endif

                       {{-- {{$post->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
