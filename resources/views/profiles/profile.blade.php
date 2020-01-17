@extends('layouts.app')

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
                <div class="card-header">profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif
                     

                    <form method="POST" action="{{ url('/addProfile') }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Enter Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="Designation" class="col-md-4 col-form-label text-md-right">{{ __('Enter Designation') }}</label>
    
                                <div class="col-md-6">
                                    <input id="Designation" type="input" class="form-control @error('Designation') is-invalid @enderror" name="Designation" required autocomplete="current-Designation">
    
                                    @error('Designation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                    <label for="Profile_pic" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="Profile_pic" type="file" class="form-control @error('profile_pic') is-invalid @enderror" name="profile_pic" required autocomplete="current-Profile_pic">
        
                                        @error('profile_pic')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                            
                                <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                {{ __('Add Profile') }}
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
