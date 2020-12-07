@extends('masterpage/masterpage')

@section('title','Delete {{$pizza->PizzaName}}')

@section('content_placeholder')
    <div class="container mt-4 bg-white">
        <div class="row pizza_detail py-5 pr-5">
            <div class="col text-center px-0">
                <img src="{{asset('storage/img/'.$pizza->ImagePath)}}" alt="{{$pizza->ImagePath}}" width="400px" height="400px">
            </div>
            <div class="col">
                <div class="d-flex flex-column">
                    <h2>{{$pizza->PizzaName}}</h2>
                    <p class="text-justify">{{$pizza->Description}}</p>
                    <span>Rp. {{$pizza->Price}}</span>
                    <div class="row mt-3">
                        <div class="container col">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">
                                Delete Pizza
                              </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="confirmModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Pizza</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete this pizza ?</p>
                </div>
                <div class="modal-footer">
                    <form action="/delete/pizza/{{$pizza->id}}" method="post">
                        {{ csrf_field() }}
                        <input type="submit" name="submit" value="Delete Pizza" class="btn btn-danger">
                    </form>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection