<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class IndexController extends Controller
{
    public function indexView(){
        $pizzas = Pizza::where('AuditActivity','!=','D')->paginate(6);
        return view('index',['pizzas'=>$pizzas]);
    }
    public function indexSearch(Request $request){
        $pizzas = Pizza::where([['PizzaName','like','%'.$request->input('query').'%'],['AuditActivity','!=','D']])->paginate(6);
        return view('index',['pizzas'=>$pizzas,'query'=>$request->input('query')]);
    }
}
