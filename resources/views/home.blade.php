
@extends('layouts.app')

<style type="text/css">
   .avatar{
        border-radius:100%;
        max-width: 150px;
   }
   h4 .dis{
       font-weight:bold;
       padding-top:10px;
  }

  .p_image{
        max-width: 200px;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
          <div class="card">
            @if(Session::has('success'))
        <div class="alert alert-success text-center">{{Session::get('success')}}</div>
                 @endif

                <div class="card-header">Dashboard</div>

                <div class="card-body row ">
                <div class="col-sm-4">

                @if(!empty($profile))

                 <img src="/storage/profilepic/{{ $profile->profile_pic }}" alt="" class="avatar">

                @else

                   <img src="{{ url('images/avatar.png') }}" alt="" class="avatar">

                @endif

                @if(!empty($profile))

                 <h4 class="dis">{{ $profile->name}}</h4>

                @else

                @endif
                  
                @if(!empty($profile))
                 <h4 class="dis">{{ $profile->designation}}</h4>
                
                @else

                @endif   

                </div>

                <div class="col-sm-8">
                @if(count ($posts) > 0)

                      @foreach($posts->all() as $post)
                          <h4>{{$post->post_title}}</h4>
                          <img src="/storage/postimages/{{$post->post_image }}" class="p_image">
                          <p>{{ $post->post_body }}</p>
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
