<?php

namespace App\Http\Controllers;
use App\PizzaCart;
use App\Pizza;
use App\Users;
use App\TransactionHeader;
use App\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function GetChartList($UserID){
        $ChartList = PizzaCart::where('UserID',$UserID)->where('AuditActivity','<>','D')->get();
        return view('master/Transaction/Chart',['ChartList'=>$ChartList]);
    }

    public function UpdateQty($UserID,$CartID,Request $request){
        $User = Users::where('UserID',$UserID)->first(); 
        $Cart = PizzaCart::where('CartID',$CartID)->first();
        PizzaCart::where('CartID',$CartID)->update(array('PizzaQty'=>$request->UpdateQty));
        PizzaCart::where('CartID',$CartID)->update(array('TotalPrice'=>($Cart->Pizza->Price * $request->UpdateQty)));
        PizzaCart::where('CartID',$CartID)->update(array('AuditUsername'=>$User->Username));
        PizzaCart::where('CartID',$CartID)->update(array('AuditTime'=>Carbon::now()->toDateTimeString()));
        PizzaCart::where('CartID',$CartID)->update(array('AuditActivity'=>'U'));

        $url = "../ViewChart/";
        $url .=$UserID;
        return redirect($url);
    }

    public function DeleteCart($UserID,$CartID){
        $User = Users::where('UserID',$UserID)->first(); 
        PizzaCart::where('CartID',$CartID)->update(array('AuditUsername'=>$User->Username));
        PizzaCart::where('CartID',$CartID)->update(array('AuditTime'=>Carbon::now()->toDateTimeString()));
        PizzaCart::where('CartID',$CartID)->update(array('AuditActivity'=>'D'));
        
        $url = "../ViewChart/";
        $url .=$UserID;
        return redirect($url);
    }

    public function SaveTransactionCheckOut($UserID){
        $User = Users::where('UserID',$UserID)->first();

        TransactionHeader::insert(array(
            'UserID' => $UserID,
            'TotalPrice' =>0,
            'TransactionDate' => Carbon::now()->toDateTimeString(),
            'AuditUsername' => $User->Username,
            'AuditTime' => Carbon::now()->toDateTimeString(),
            'AuditActivity' => 'I'
        ));

        $ChartList = PizzaCart::where('UserID',$UserID)->where('AuditActivity','<>','D')->get();
        $CurrentHeaderTransaction = TransactionHeader::where('UserID',$UserID)->orderBy('id','desc')->first();
        $TotalPrice = 0;
        foreach($ChartList as $Data){
            TransactionDetail::insert(array(
                'HTransactionID' => $CurrentHeaderTransaction->id,
                'PizzaID' => $Data->PizzaID,
                'SubTotal' => $Data->TotalPrice,
                'Qty' => $Data->PizzaQty,
                'AuditUsername' => $User->Username,
                'AuditTime' => Carbon::now()->toDateTimeString(),
                'AuditActivity' => "I"
            ));
            $TotalPrice = $TotalPrice + $Data->TotalPrice;
            PizzaCart::where('CartID',$Data->CartID)->update(array('AuditUsername'=>$User->Username));
            PizzaCart::where('CartID',$Data->CartID)->update(array('AuditTime'=>Carbon::now()->toDateTimeString()));
            PizzaCart::where('CartID',$Data->CartID)->update(array('AuditActivity'=>'D'));
        }
       TransactionHeader::where('id',$CurrentHeaderTransaction->id)->update(array('TotalPrice'=>$TotalPrice));

        // $url = "../ViewChart/";
        // $url .=$UserID;
        return redirect('/')->with('pizzaDeleted', "Transaction success!");
    }

    public function AddCart($UserID,Request $request){
        $PizzaID = $request->HfPizzaID;
        $PizzaQty = $request->AddCartPizzaQty;
        $Pizza = Pizza::where('id',$PizzaID)->first(); 
        $User = Users::where('UserID',$UserID)->first();
        $Exists = PizzaCart::where('PizzaID',$PizzaID)->where('UserID',$UserID)->where('AuditActivity','<>','D')->first();
        if($Exists != null){
            $NewQty = $Exists->PizzaQty + $PizzaQty;
            $Price = $Pizza->Price * $NewQty; 
            PizzaCart::where('CartID',$Exists->CartID)->update(array('PizzaQty'=>$NewQty));
            PizzaCart::where('CartID',$Exists->CartID)->update(array('TotalPrice'=>$Price));
            PizzaCart::where('CartID',$Exists->CartID)->update(array('AuditUsername'=>$User->Username));
            PizzaCart::where('CartID',$Exists->CartID)->update(array('AuditTime'=>Carbon::now()->toDateTimeString()));
            PizzaCart::where('CartID',$Exists->CartID)->update(array('AuditActivity'=>'U'));
        }
        else{
            $Price = $Pizza->Price * $PizzaQty;
            PizzaCart::insert(array(
                'UserID'=>$UserID,
                'PizzaID' =>$PizzaID,
                'PizzaQty' =>$PizzaQty,
                'TotalPrice'=>$Price,
                'AuditUsername'=>$User->Username,
                'AuditTime' => Carbon::now()->toDateTimeString(),
                'AuditActivity' => 'I'
            ));
        }
        $url = "../ViewChart/";
        $url .=$UserID;
        return redirect($url);
    }

    public function viewTransaction($UserID){
        $transactions = TransactionHeader::where('UserID',$UserID)->get();

        return view('master/Transaction/History',['transactions'=>$transactions]);
    }

    public function viewTransactionDetail($TranID){
        $transactions = TransactionDetail::where([['HTransactionID',$TranID],['AuditActivity','<>','D']])->get();

        return view('master/Transaction/Detail',['transactions'=>$transactions]);
    }
}

