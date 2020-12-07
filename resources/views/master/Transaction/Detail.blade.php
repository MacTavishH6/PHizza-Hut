@extends('masterpage/masterpage')

@section('content_placeholder')
<div class="container mt-4 bg-white">
    @foreach ($transactions as $transaction)
        <div class="row pizza_detail py-3 pr-5">
            <div class="col-2"></div>
            <div class="col-3 text-center px-0">
                <img src="{{asset('storage/img/'.$transaction->Pizza->ImagePath)}}" alt="{{$transaction->Pizza->ImagePath}}" width="200px" height="200px">
            </div>
            <div class="col">
                <div class="d-flex flex-column">
                    <h2>{{$transaction->Pizza->PizzaName}}</h2>
                    <span>Rp. {{$transaction->Pizza->Price}}</span>
                    <div class="row">
                        <div class="col-3">
                            <label>Quantity:</label>
                        </div>
                        <div class="col">
                            {{$transaction->Qty}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">Total Price:</div>
                        <div class="col">{{$transaction->SubTotal}}</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection