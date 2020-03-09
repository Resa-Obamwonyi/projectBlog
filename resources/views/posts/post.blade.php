@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Post</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/addPost') }}" enctype="multipart/form-data">
                        @csrf
                   @if(count($errors) > 0)
                      @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                      @endforeach
                    @endif

                    @if(session('response'))
                       <div class="alert alert-success">{{session('response')}}</div>
                    @endif
                        <div class="form-group row">
                            <label for="post" class="col-md-4 col-form-label text-md-right">{{ __('Post Title') }}</label>

                            <div class="col-md-8 form-group">
                                <input id="post_title" type="text" class="form-control" name="post_title" value="">
                            </div>

                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Post Body') }}</label>

                            <div class="col-md-8 form-group">
                                <textarea id="post_body" class="form-control" rows="7" name="post_body" value=""></textarea>
                            </div>

                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-8 form-group">
                                <select id="category_id" class="form-control" name="category_id" value="">
                                    <option value=""></option>

                                @if(count($categories) > 0)
                                    @foreach($categories->all() as $category)

                                      <option value="{{$category->id}}">{{$category -> category}}</option>

                                    @endforeach

                                @endif
                                </select>
                            </div>

                            <label for="post_image" class="col-md-4 col-form-label text-md-right">{{ __('Post Image') }}</label>

                            <div class="col-md-8 form-group">
                                <input id="post_image" type="file" class="form-control" name="post_image" value="">
                            </div>

                            
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Publish Post') }}
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