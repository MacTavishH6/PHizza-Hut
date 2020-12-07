@extends('masterpage/masterpage')

@section('title','Phizza Hut | Welcome!')

@section('css_placeholder')
    <style>
        .search-bar{
            width: 70% !important;
        }
        .pizza_info{
            width: auto;
        }
        .pizza_label, .pizza_price{
            max-width: 200px !important;
        }
        .pizza_info{
            width: fit-content;
            margin: 0;
        }
        .pizza{
            width: fit-content;
            max-width: 350px;
        }
    </style>
@endsection

@section('content_placeholder')
    <div class="container mt-4">
        <h1>Our freshly made pizza!</h1>
        <div class="container mx-5">
            <h2>order it now!</h2>
            <form action="/search" method="GET" class="form-inline">
                <input type="search" class="form-control search-bar" placeholder="Search Pizza" aria-label="Search Pizza" name="query" value="@if(isset($query)){{$query}}@endif">
                <button class="btn btn-primary my-2 my-sm-0 mx-1 px-4" type="submit" >Search</button>
            </form>
            <button class="btn btn-dark mt-2" onclick="window.location.href = 'add'">Add Pizza</button>
            @if(session('pizzaDeleted'))
                <div class="alert alert-success mt-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{session('pizzaDeleted')}}
                </div>
            @endif
            @if ($pizzas->count() < 1)
                <div class="col text-center">
                    <h1>No Pizza..</h1>
                </div>
            @else
                @foreach ($pizzas->chunk(3) as $chunked_pizza)
                    <div class="row pizza_list mt-4">
                        @foreach ($chunked_pizza as $pizza)
                            <div class="col px-0 pizza d-flex flex-column border bg-white">
                                <img class="mx-auto pt-3" src="{{asset('storage/img/'.$pizza->ImagePath)}}" alt="{{$pizza->ImagePath}}" width="300px" height="200px">
                                <div class="pizza_info pl-4 d-flex flex-column mt-2">
                                    <label class="pizza_label">{{$pizza->PizzaName}}</label>
                                    <label class="pizza_price">Rp. {{$pizza->Price}}</label>
                                </div>
                                {{-- <div class="customer_button mx-auto mb-3">
                                    <button class="btn btn-outline-info" onclick="window.location.href = 'detail/{{$pizza->id}}'">View Detail</button>
                                </div> --}}
                                <div class="admin_buttons mx-auto mb-3">
                                    <button class="btn btn-primary mr-5" onclick="window.location.href = 'update/{{$pizza->id}}'">Update Pizza</button>
                                    <button class="btn btn-danger ml-4" onclick="window.location.href = 'delete/{{$pizza->id}}'">Delete Pizza</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                {{$pizzas->Links()}}
            @endif
        </div>
    </div>
@endsection