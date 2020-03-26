
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
        width: 70%;
        display: block;
        margin-right: auto;
        margin-left: auto;
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


                <div class="card-body row">
                <div class="col-sm-4">

                @if(!empty($profile))

                 <img src="/storage/profilepic/{{ $profile->profile_pic }}" alt="" class="avatar">

                @else

                   <img src="{{ url('images/avatar.png') }}" alt="" class="avatar">

                @endif

                @if(!empty($profile))

                 <h4 class="dis" style="padding-top: 15px;">{{ $profile->name}}</h4>

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
                          <h2 style="padding-top: 10px; text-align: center;">{{$post->post_title}}</h2>
                          <img style="padding-top: 15px;" src="/storage/postimages/{{$post->post_image }}" class="p_image">
                          <p style="padding-top: 15px;">{{ substr( $post->post_body, 0, 150) }}</p>
                           
                           <ul class="nav nav-pills">

                             <li role="presentation" style=" padding-right:20px;">
                               <a href='{{ url("/view={$post->id}") }}'>
                                 <span class="fa fa-eye"> View</span>
                               </a>
                             </li>
                              @if(Auth::user()->id ==1)
                              <li role="presentation" style=" padding-right:20px;">
                               <a href='{{url("/edit={$post->id}")}}'>
                                 <span class="fa fa-pencil"> Edit</span>
                               </a>
                             </li>

                             <li role="presentation" style=" padding-right:20px;">
                               <a href='{{url("/delete={$post->id}")}}'>
                                 <span class="fa fa-trash"> Delete</span>
                               </a>
                             </li>
                                @endif


                           </ul>

                          <cite style="float: left;">Posted on: {{date('M j, Y H:i', strtotime($post->updated_at))}}</cite>

                          <br>


                          <hr>
                      @endforeach

                @else
                     <p>No Posts Available</p>
                @endif

                {{ $posts->links()}}
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
