@extends('masterpage/masterpage')

@section('title','PHizza Hut | '.$pizza->PizzaName)

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

                    {{-- Validation if the user input quanityt less then 1 --}}
                    @if ($errors->any())
                         <div class="alert alert-danger" style="margin-top: 20px">
                            <ul>
                            @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                            @endforeach
                             </ul>
                           </div>
                     @endif

                    @if (Auth::check() && Auth::user()->isAdmin == 0)
                        <form action="/AddCart/{{$UserID}}" method="POST"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row mt-5">
                                <div class="col-2">
                                    <label>Quantity:</label>
                                </div>
                                <div class="col">
                                <input name="HfPizzaID" id="HfPizzaID" type="hidden" value="{{$pizza->id}}">
                                <input type="number" name="Quantity" id="Quantity">
                                    
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="container col mx-5">
                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

