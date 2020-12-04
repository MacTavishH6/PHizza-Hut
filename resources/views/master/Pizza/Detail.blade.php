@extends('masterpage/masterpage')

@section('title','Pizza Detail')

@section('content_placeholder')
    <div class="container mt-4 bg-white">
        <div class="row pizza_detail py-5 pr-5">
            <div class="col text-center px-0">
                <img src="{{asset('storage/img/'.$pizza->ImagePath)}}" alt="$pizza->ImagePath" width="400px" height="400px">
            </div>
            <div class="col">
                <div class="d-flex flex-column">
                    <h2>{{$pizza->PizzaName}}</h2>
                    <p class="text-justify">{{$pizza->Description}}</p>
                    <span>Rp. {{$pizza->Price}}</span>
                    <!--<div class="row mt-5">
                        <div class="col-2">
                            <label>Quantity:</label>
                        </div>
                        <div class="col">
                            <input type="number" name="quantity" id="quantity">
                        </div>
                    </div>-->
                    <!--<div class="row mt-3">
                        <div class="container col mx-5">
                            <button class="btn btn-primary">Add to cart</button>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
@endsection