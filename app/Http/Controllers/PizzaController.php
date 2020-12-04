<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Pizza;
use Carbon\Carbon;
use Storage;
use Artisan;

class PizzaController extends Controller
{
    //
    public function validateRequest($request){
        $validated = Validator::make($request->all(),[
            'name'=>'required|string|max:20',
            'price'=>'required|numeric|min:10000',
            'desc'=>'required|string|min:20',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        return $validated;
    }

    public function pizzaBuilder($pizza, $pizzaData, $imageName, $UserID, $isUpdate){
        $auditTime = Carbon::now();
        $pizza->PizzaName = $pizzaData['name'];
        $pizza->Price = $pizzaData['price'];
        $pizza->Description = $pizzaData['desc'];
        $pizza->ImagePath = $imageName;
        $pizza->AuditUsername = $UserID;
        $pizza->AuditTime = $auditTime->toDateTimeString();;
        if($isUpdate == true) $pizza->AuditActivity = 'U';
        else $pizza->AuditActivity = 'I';

        return $pizza;
        
    }

    public function addView(){
        return view('master/Pizza/AddPizza');
    }
    public function addPizza(Request $request){
        $validated = $this->validateRequest($request);
        if ($validated->fails()) return redirect()->back()->withInput($request->all())->withErrors($validated->errors());
        $imageName = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('storage/img'), $imageName);
        $UserID = 'Wira';
        try{
            $pizza = new Pizza;
            $pizza = $this->pizzaBuilder($pizza, $request->all(), $imageName, $UserID, false);
            $pizza->save();
            return redirect('/add')->with('status',"Pizza added successfully!");
        }
        catch(Exception $e){
            return redirect('/add')->with('failed',"Error occured when saving Pizza..");
        }
    }

    public function pizzaDetail($id){
        $pizza = Pizza::find($id);

        return view('master/Pizza/Detail',['pizza'=>$pizza]);
    }

    public function pizzaUpdateView($id){
        $pizza = Pizza::find($id);

        return view('master/Pizza/UpdatePizza',['pizza'=>$pizza]);
    }

    public function pizzaUpdate($id, Request $request){
        $pizza = Pizza::find($id);
        $validated = $this->validateRequest($request);
        if ($validated->fails()) return redirect()->back()->with('pizza',$pizza->all())->withErrors($validated->errors());
        $imageName = $request->file('photo')->getClientOriginalName();
        Storage::disk('public')->put('img/'.$imageName, $request->file('photo'), 'public');
        Artisan::call('storage:link', [] );
        $UserID = 'Wira';
        try{
            $pizza = $this->pizzaBuilder($pizza, $request->all(), $imageName, $UserID, true);
            $pizza->save();
            return redirect('/update/'.$id)->with('status',"Pizza updated successfully!");
        }
        catch(Exception $e){
            return redirect('/update/'.$id)->with('failed',"Error occured when saving Pizza..");
        }
    }

    public function deleteView($id){
        $pizza = Pizza::find($id);

        return view('master/Pizza/Delete',['pizza'=>$pizza]);
    }

    public function delete($id){
        $auditTime = Carbon::now();
        $pizza = Pizza::find($id);
        $pizza->AuditUsername = 'Wira';
        $pizza->AuditTime = $auditTime->toDateTimeString();;
        $pizza->AuditActivity = 'D';
        $pizza->save();
        return redirect('/')->with('pizzaDeleted', "Pizza deleted Succesfully!");
    }
}
