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
            <div class="card-header"><img src="{{asset('feed.jpeg')}}" style="width:20px;"></div>
                 
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                <div class="card-body row">
                   <div class="col-md-4">
                        <ul class="list-group">
                            @if (count($categories) > 0 )
                            @foreach ($categories->all() as $categorie)
                            <li class="list-group-item">
                                <a   href='{{ url("category/{$categorie->id}")}}'>{{$categorie->
                                 category}}</a>
                            </li>
                            @endforeach
                                
                            @else
                               <p>NO CATEGORY FOUND!</p> 
                            @endif
                                
                        </ul>
                   </div>
                   <div class="col-md-8">
                        @if ((count($post) > 0 ))
                         @foreach ($post->all () as $post)
                         <h3 class="text-center">{{$post->post_title}}</h3>
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
                                             <span class="fa fa-comment">Comment</span>
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

            
                                    
                                    
                                    <hr />
                                    @foreach($post->comments as $comment)
                                        <div class="display-comment card mt-3">
                                            <div class="card-body">
                                                    <p>{{ $comment->content }}</p>
                                                    <cite>by {{ $comment->user->name }}</cite>
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr />


                                   

            <div class="card mt-3">
                
                <form method="post" action="/comment">
            
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
            
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
            
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
            
                    <fieldset>
                        <legend class="ml-3">Reply</legend>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                            </div>
                        </div>
            
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
