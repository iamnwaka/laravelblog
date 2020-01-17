@extends('layouts.app')


<style>
        ul li>a {
          color: #3490dc;
          padding-right: 0.5rem;
          padding-left: 0.5rem;
      }
      ul li>a:hover {
          background-color:#a7ffff;
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
                <div class="card-header">Posts View</div>

                <div class="card-body row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div class="col-md-4">
                        <ul class="list-group">
                            @if (count($categories) > 0 )
                            @foreach ($categories->all() as $categories)
                            <li class="list-group-item"><a href='{{ url("categories/{$categories->id}")}}'>{{$categories->
                            $categories}}</a></li>
                            @endforeach
                                
                            @else
                               <p>NO CATEGORY FOUND!</p> 
                            @endif
                                
                        </ul>
                   </div>
                   <div class="col-md-8">
                        @if ((count($post) > 0 ))
                         @foreach ($post->all () as $post)
                         <h3>{{$post->post_title}}</h3>
                         <img src="/storage/posts/images/{{$post->post_image}}" class="img-fluid image-post">
                         <p>{{$post->post_body}}</p>
                         
 
                          <ul class="nav nav-pills">
                             <li role="presentation">
                                     <a href='{{url("/like/{$post->id}")}}'>
                                     <span class="fa fa-thumbs-up"> Like ({{$likeCtr}})</span>
                                 </a>
                             </li>
                             <li role="presentation">
                                     <a href='{{url("/dislike/{$post->id}")}}'>
                                         <span class="fa fa-thumbs-down"> Dislike ({{$dislikeCtr}})</span>
                                     </a>
                                 </li>
                                 <li role="presentation">
                                         <a href='{{url("/comment/{$post->id}")}}'>
                                             <span class="fa fa-comment-o"> Comment ()</span>
                                         </a>
                                     </li>
                          </ul>
           
 
                         
                         @endforeach
                            
                        @else
                            <p>No Post Available!</p>
                        @endif

                        
                     </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@include('posts.show')

@endsection
