@extends('masterpage/masterpage')

@section('title','PHizza Hut | View All User')

@section('content_placeholder')
    <div class="container" style=";width: 50%;margin-top: 50px">
        <div class="content" style="height: 100%;margin-top: 10px ">
                <div class="row">
                    @foreach ($UsersDetail as $Data)
                    <div class="col-sm-5" style="margin-top: 15px;">
                        <div class="col px-0 pizza d-flex flex-column border bg-white">
                            <div class="User-content" >
                            <h3 class="title" style="background-color:red;padding: 10px 0px 10px 10px;color: white">User ID: {{$Data->UserID}}</h3>
                            <div style="margin-left: 10px">
                            <p>Username: {{$Data->Username}}</p>
                            <p>Email: {{$Data->email}}</p>
                            <p>Address: {{$Data->Address}}</p>
                            <p>Phone Number: {{$Data->PhoneNumber}}</p>
                            <p>Gender: {{$Data->Gender}}</p>
                            </div>
                            
                            <br>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                   
                  </div>
                
        </div>
    </div>
@endsection