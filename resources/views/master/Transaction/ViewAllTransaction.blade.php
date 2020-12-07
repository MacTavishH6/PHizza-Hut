@extends('masterpage/masterpage')

@section('title','View All Transaction')

@section('css_placeholder')
    <style>
        .ganjil{
            background-color: #f7344b;
        }
        .labelTran:hover{
            cursor: pointer;
        }
    </style>
@endsection

@section('content_placeholder')
    <div class="container">
        <?php $index = 1 ?>
        @foreach ($transactions as $transaction)
            <div class="row mx-auto w-50 <?php if($index == 1) echo "mt-5" ?> ">
                <div class="col">
                    @if ($index % 2 == 1)
                    <a href="/history/detail/{{$transaction->id}}">
                        <div class="row ganjil mx-auto px-4 py-3 border rounded">
                            <div class="col d-flex flex-column">
                                <div class="row">
                                    <label class="labelTran text-white p-0 m-0">Transaction at {{$transaction->TransactionDate}}</label>
                                </div>
                                <div class="row">
                                    <label class="labelTran text-white p-0 m-0">User ID: {{$transaction->UserID}}</label>
                                </div>
                                <div class="row">
                                    <label class="labelTran text-white p-0 m-0">Username: {{$transaction->User->Username}}</label>
                                </div>
                            </div>
                        </div>
                    </a>
                    @else
                    <a href="/history/detail/{{$transaction->id}}">
                        <div class="row mx-auto px-4 py-3 bg-white border rounded">
                            <label class="labelTran text-dark">Transaction at {{$transaction->TransactionDate}}</label>
                        </div>
                    </a>
                    @endif
                    <?php ++$index ?>
                </div>
            </div>
        @endforeach
    </div>
@endsection