@extends('masterpage/masterpage')

@section('content_placeholder')
<div class="container" style=";width: 50%;margin-top: 50px">
    <div class="content" style="height: 100%;margin-top: 10px ">
        
        <div class="col d-flex flex-column border bg-white" style="margin-bottom: 20px">
        <div class="row" style="background-color: red ">
            <h2 style="margin-left: 40px;color: white;">Register</h2>
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

        <div style="margin-left: 200px">
            <form action="/SubmitRegistration" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row form-group mt-5">
                    <div class="col-3">Username :</div>
                    <div class="col-6"><input type="text" class="form-control" name="username" id="username" value="{{old('username')}}"></div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-3">E-Mail Address :</div>
                    <div class="col-6"><input type="email" class="form-control" name="email" id="email" value="{{old('email')}}"></div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-3">Password :</div>
                    <div class="col-6"><input type="password" class="form-control" name="password" id="password" value="{{old('password')}}"></div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-3">Confirm Password:</div>
                    <div class="col-6"><input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" value="{{old('conPassword')}}"></div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-3">Address :</div>
                    <div class="col-6"><input type="text" class="form-control" name="address" id="address" value="{{old('address')}}"></div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-3">Phone Number :</div>
                    <div class="col-6"><input type="number" class="form-control" name="phoneNumber" id="phoneNumber" value="{{old('phoneNumber')}}"></div>
                </div>
                <div class="row form-group mt-4">
                    <div class="col-3">Gender: </div>
                    <div class="col-6">
                        <input type="radio" name="gender" id="gender" value="Male"> <span style="margin-left:10px;margin-right: 15px">Male</span>
                        <input type="radio" name="gender" id="gender" value="Female"> <span style="margin-left:10px">Female</span>
                    </div>
                </div>
                <br>
                <div class="row mb-3">
                    <div class="col" style="margin-left: 250px">
                        <input type="submit" name="submit" class="btn btn-primary" value="Register">
                    </div>
                </div>

                
            </form>
        </div>
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
         

        </div>

    </div>

    

</div>
@endsection