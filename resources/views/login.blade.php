@extends('masterpage/masterpage')

@section('content_placeholder')
<div class="container" style=";width: 50%;margin-top: 50px">
    <div class="content" style="height: 100%;margin-top: 10px ">
        
        <div class="col d-flex flex-column border bg-white" style="margin-bottom: 20px">
        <div class="row" style="background-color: red ">
            <h2 style="margin-left: 40px;color: white;">Login</h2>
        </div>

          @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 20px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        @if(session('failed'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('failed') }}
                </div>
            @elseif(session('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('status') }}
                </div>
            @endif

        <div style="margin-left: 200px">
            <form action="/Auth" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row form-group mt-4">
                    <div class="col-3" style="text-align: right">E-Mail Address :</div>
                    <div class="col-6"><input type="email" class="form-control" name="email" id="email" value="{{old('email')}}"></div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-3" style="text-align: right">Password :</div>
                    <div class="col-6"><input type="password" class="form-control" name="password" id="password" value="{{old('password')}}"></div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-12" style="margin-left: 230px"><input type="checkbox" style="width: 20px;height: 20px;" class="form-control" name="rememberMe" id="rememberMe" value="{{old('rememberMe')}}">
                        <span>Remember Me</span>
                    </div>
                    
                </div>
                <br>
                <div class="row mb-3">
                    <div class="col" style="margin-left: 225px">
                        <input type="submit" name="submit" class="btn btn-primary" value="Login">
                    </div>
                </div>

                
            </form>
        </div>

         

        </div>

    </div>

    

</div>
@endsection