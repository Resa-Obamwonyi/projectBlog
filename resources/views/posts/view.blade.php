
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

@media screen and (max-width: 768px) {

.cat{
  display: none;
}

}

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

                <div class="card-header">Post View</div>

                <div class="card-body row">

                <div class="col-sm-4 cat">
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
                          <img style="padding-top: 15px;" src="https://einkbucket.s3.eu-west-2.amazonaws.com/{{$post->post_image}}" class="p_image">
                          <p style="padding-top: 15px; text-align: left;">{{ $post->post_body }}</p>
                           
                           <ul class="nav nav-pills">

                             <li role="presentation" style=" padding-right:20px;">
                               <a href='{{ url("/like/{$post->id}") }}'>
                                 <span class="fa fa-thumbs-up"> Like ({{$likeCount}})</span>
                               </a>
                             </li>

                             <li role="presentation" style=" padding-right:20px;">
                               <a href='{{url("/dislike/{$post->id}")}}'>
                                 <span class="fa fa-thumbs-down"> Dislike ({{$dislikeCount}})</span>
                               </a>
                             </li>

                             <li role="presentation" style=" padding-right:20px;">
                               <a href='{{url("/comment/{$post->id}")}}'>
                                 <span class="fa fa-comment-o"> Comment</span>
                               </a>
                             </li>

                           </ul>
                <br>

                @endforeach

                @else
                     <p>No Posts Available</p>
                @endif

                <form method="POST" action='{{ url("/comment/{$post->id} ") }}'>
                {{ csrf_field()}}
                @if(count($errors) > 0)
                      @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                      @endforeach
                    @endif
                  <div class="form-group">
                    <textarea id="comment" rows="6" class="form-control" name="comment" required-autofocus></textarea>                    
                  </div>
                  <div class="form-group">
                    <button class="btn btn-success  btn-block" type="submit">Post Comment</button>
                  </div>
               </form>
            <h4 style="text-align: left;">Comments</h4>
            @if(count($comments) > 0)
            @foreach($comments->all() as $comments)
               <div style="text-align: left;">
                 <h5>{{$comments->name}}</h5>
                 <p>{{$comments->comment}}</p>
                 <hr/>
               </div>
                 @endforeach
                  @else
                     <div style="text-align: left;">
                     <p>No Comments Available</p>
                     <hr/>
                     </div>
                 @endif

                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
