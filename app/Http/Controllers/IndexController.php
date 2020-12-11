<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class IndexController extends Controller
{
    //Get list pizza data for main menu
    public function indexView(){
        $pizzas = Pizza::where('AuditActivity','!=','D')->paginate(6);
        return view('index',['pizzas'=>$pizzas]);
    }
    
    //get list pizza data for main menu by input search
    public function indexSearch(Request $request){
        $pizzas = Pizza::where([['PizzaName','like','%'.$request->input('query').'%'],['AuditActivity','!=','D']])->paginate(6);
        return view('index',['pizzas'=>$pizzas,'query'=>$request->input('query')]);
    }
}
