@extends('/layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <div class="container">
          <br>
          <div class="text-center">
          <h2>Category</h2>
          </div>
             <form method="POST" action="{{ url('/addCategory') }}">
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
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __(' Post Title') }}</label>

                            <div class="col-md-6">
                                <input id="category" type="text" class="form-control" name="category" value="">
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Category') }}
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