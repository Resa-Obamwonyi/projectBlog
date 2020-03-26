
@extends('layouts.app')

<style type="text/css">

    h4 .dis{
       font-weight:bold;
       padding-top:10px;
  }

  .p_image{
        width: 70%;
        display: block;
        margin-right: auto;
        margin-left: auto;
            }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9 text-center">
          <div class="card">
            @if(Session::has('success'))
        <div class="alert alert-success text-center">{{Session::get('success')}}</div>
                 @endif

                <div class="card-header">Category View</div>

                <div class="card-body row">
                <div class="col-sm-4">
                  <ul class="list-group">
                    @if(count($categories) > 0)
                       @foreach($categories->all() as $category)
                    <li class="list-group-item"><a href='{{url("category={$category->id}")}}'>{{$category->category}}</a></li>
                    <hr>
                       @endforeach
                    @else
                      <p>No Category Available</p>
                    @endif

                  
                  </ul>


                </div>

                <div class="col-sm-8">
                                        @if(count ($posts) > 0)

                      @foreach($posts->all() as $post)
                          <h2 style="padding-top: 10px; text-align: center;">{{$post->post_title}}</h2>
                          <img style="padding-top: 15px;" src="/storage/postimages/{{$post->post_image }}" class="p_image">
                          <p style="padding-top: 15px; text-align: left;">{{ $post->post_body }}</p>
                        

                          <br>


                          <hr>
                      @endforeach

                @else
                     <p>No Posts Available</p>
                @endif
               
               
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
