@extends('/layout')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success text-center">{{Session::get('success')}}</div>
@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <div class="container">
          <br>
          <div class="text-center">
          <h2>Profile</h2>
          </div>
             <form method="POST" action="{{ url('/addProfile') }}" enctype="multipart/form-data" >
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __(' Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __(' Designation') }}</label>

                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control" name="designation" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_pic" class="col-md-4 col-form-label text-md-right">{{ __(' Profile Picture') }}</label>

                            <div class="col-md-6">
                                <input id="profile_pic" type="file" class="form-control" name="profile_pic" value="">
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>

  @endsection('content')