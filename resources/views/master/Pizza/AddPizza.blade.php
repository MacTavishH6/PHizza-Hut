@extends('masterpage/masterpage')

@section('title','Add New Pizza')

@section('content_placeholder')
    <div class="container bg-white px-5 mt-4 pb-3">
        <div class="d-flex-flex-column">
            <h1>Add New Pizza</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/addPizza" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row form-group mt-3">
                    <div class="col-4">Pizza Name:</div>
                    <div class="col-6"><input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"></div>
                </div>
                <div class="row form-group">
                    <div class="col-4">Pizza Price:</div>
                    <div class="col-6"><input type="number" class="form-control" name="price" id="price" value="{{old('price')}}"></div>
                </div>
                <div class="row form-group">
                    <div class="col-4">Pizza Description:</div>
                    <div class="col-6"><input type="text" class="form-control" name="desc" id="desc" value="{{old('desc')}}"></div>
                </div>
                <div class="row form-group">
                    <div class="col-4">Pizza Photo:</div>
                    <div class="col-6"><input type="file" name="photo" id="photo" value="{{old('photo')}}"></div>
                </div>
                @if ($errors->any() && $errors->first('photo') != 'The Pizza Photo field is required.')
                    <div class="row form-group mt-n3">
                        <div class="col-4"></div>
                        <div class="col text-danger">Please upload the Pizza Photo again!</div>
                    </div>
                @endif
                <div class="row mb-4">
                    <div class="col"><input type="submit" name="submit" class="btn btn-primary" value="Add Pizza"></div>
                </div>
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
@endsection