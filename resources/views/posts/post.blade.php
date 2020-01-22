@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">posts</div>

                <div class="card-post_body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                    <form  method="post" action="{{url('/addPost') }}" enctype="multipart/form-data">
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
    
                        {{ csrf_field() }}
                        <div class="form-group row mt-5">
                            <label for="post_title" class="col-md-4 col-form-label text-md-right">Title</label>
                            <div class="col-md-6">
                                <input id="text" class="form-control" type="text" placeholder="post-title" name="post_title" value="{{ old('name') }}">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="post_body" class="col-md-4 col-form-label text-md-right">Body</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="email" rows="7" placeholder="maiores assumenda explicabo soluta cumque perspiciatis rerum deleniti iste recusandae?" name="post_body" value="{{ old('post_body') }}"></textarea>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">Category</label>
                            <div class="col-md-6">
                                <select type="category_id" class="form-control"  name="category_id">
                                    <option value="" style="font-size:30px;">Select</option>
                                    @if(count($categories) > 0 )
                                      @foreach ($categories->all() as $categories)
                                      <option value="{{$categories->id}}">{{$categories->category}}</option>
                                      @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="post_image" class="col-md-4 col-form-label text-md-right">{{ __('Featured Image') }}</label>

                            <div class="col-md-6">
                                <input id="post_image" type="file" class="form-control @error('post_image') is-invalid @enderror" name="post_image" required autocomplete="current-post_image">

                                @error('post_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group ">
                            <div class="col-md-12 col-lg-offset-4">
                                <button type="submit" class="btn btn-primary btn-large btn-block">
                                    Publish Post
                                </button>
                            </div>
                        </div>
                    </form>  
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
