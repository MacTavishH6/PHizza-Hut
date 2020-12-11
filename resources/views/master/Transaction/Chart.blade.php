@extends('masterpage/masterpage')

@section('title','PHizza Hut | '.Auth::user()->Username.' Cart')

@section('content_placeholder')
<div class="container" style=";width: 75%;margin-top: 50px">
    <div class="content" style="height: 100%;margin-top: 10px ">
        @if(count($ChartList) < 1 )
          <h1 class="text-center">Chart is empty, please order!!</h1>
        @endif
        @foreach ($ChartList as $Data)
        <div class="col px-0 pizza d-flex flex-column border bg-white" style="margin-bottom: 20px">
        <div class="row">
            <div class="col-sm-4">
                <img width="280px" height="280px" src="{{asset('storage/img/'.$Data->Pizza->ImagePath)}}" style="padding: 50px 10px 10px 40px">
            </div>
            <div class="col-sm-7">
            <h2 style="margin-top:30px ">{{$Data->Pizza->PizzaName}}</h2>
            <p>Rp. {{$Data->Pizza->Price}}</p>
            <p>Quantity : {{$Data->PizzaQty}}</p>
            <form action="../UpdateChartQty/{{$Data->UserID}}/{{$Data->CartID}}" method="POST">
                {{ csrf_field() }}
                <span>Quantity: </span>
                <input style="margin-left: 200px;width: 300px" id="UpdateQty" type="number" name="UpdateQty" value={{$Data->PizzaQty}}>
                <p>SubTotal: Rp. {{$Data->TotalPrice}}</p>
                <br>
                <button type="submit" class="btn btn-primary" style="margin-bottom: 10px;width: 160px;color: white">Update Quantity</button>
                <br>
            </form>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" style="margin-bottom: 40px;width: 160px">Delete From Cart</button>
            
            {{-- Modal Start Here --}}
            <div class="modal" id="confirmModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete Cart</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to delete this cart ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      <a href="../DeleteCart/{{$Data->UserID}}/{{$Data->CartID}}" class="btn btn-danger" style="width: 160px;color: white">Delete From Chart</a>
                    </div>
                  </div>
                </div>
              </div>
              {{-- Modal End Here --}}

            </div>
        </div> 
        </div>
        @endforeach
        @if(count($ChartList) > 0)
        <div style="margin-left: 520px">
        <?php $total = 0 ?>
        @for ($i = 0; $i < count($ChartList); $i++)
            <?php $total += $ChartList[$i]->TotalPrice ?>
        @endfor
        <h2>Total Price: Rp. 
          {{$total}}
        </h2>
        
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#CheckOutModal" style="margin-bottom: 40px;width: 160px;color: white;">Checkout</button>
        {{-- Modal Start Here --}}
        <div class="modal" id="CheckOutModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Checkout</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to checkout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger   " data-dismiss="modal">Close</button>
                  <a href="../CheckOutPizza/{{$Data->UserID}}" class="btn btn-primary" style="color: white">Checkout</a>
                </div>
              </div>
            </div>
          </div>
          {{-- Modal End Here --}}
        </div>
       
            @endif
    </div>

    

</div>
@endsection