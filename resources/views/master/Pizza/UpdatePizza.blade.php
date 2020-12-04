@extends('masterpage/masterpage')

@section('title','Add Pizza')

@section('content_placeholder')
    <div class="container bg-white px-5 mt-4">
        <div class="row pt-3">
            <div class="col-4 text-center px-0">
                <img src="{{ asset('storage/img/'.$pizza->ImagePath) }}" alt="{{$pizza->ImagePath}}" width="300px">
            </div>
            <div class="col d-flex-flex-column">
                <h1>Update {{$pizza->PizzaName}}</h1>
                <form action="/update/pizza/{{$pizza->id}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row form-group mt-3">
                        <div class="col-4">Pizza Name:</div>
                        <div class="col-6"><input type="text" class="form-control" name="name" id="name" value="{{$pizza->PizzaName}}"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4">Pizza Price:</div>
                        <div class="col-6"><input type="number" class="form-control" name="price" id="price" value="{{$pizza->Price}}"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4">Pizza Description:</div>
                        <div class="col-6"><input type="text" class="form-control" name="desc" id="desc" value="{{$pizza->Description}}"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-4">Pizza Photo:</div>
                        <div class="col-6"><input type="file" name="photo" id="photo"></div>
                    </div>
                    <div class="row">
                        <div class="col mb-4"><input type="submit" class="btn btn-primary" value="Update Pizza" name="submit"></div>
                    </div>
                    @if ($errors->any())
                    <div class="row alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </form>
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