<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Pizza;
use Carbon\Carbon;
use Storage;
use Artisan;
use Illuminate\Support\Facades\Auth;

class PizzaController extends Controller
{
    //this funtion used for validate user request form
    public function validateRequest($request){
        $validated = Validator::make($request->all(),[
            'name'=>'required|string|max:20',
            'price'=>'required|numeric|min:10000',
            'desc'=>'required|string|min:20',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        return $validated;
    }

    //this function used for making pizza object
    public function pizzaBuilder($pizzaData, $imageName, $UserID, $isUpdate){
        $pizza = new Pizza;
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

    //this function used for edit pizza
    public function updatePizza($pizza, $pizzaData, $imageName, $UserID, $isUpdate){
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

    //this function is for redirect to add pizza view
    public function addView(){
        return view('master/Pizza/AddPizza');
    }

    //this function is for adding pizza to db
    public function addPizza(Request $request){

        //first validate the user request form
        $validated = $this->validateRequest($request);

        //if user request form invalid, then redirect to previous page with error detail
        if ($validated->fails()) return redirect()->back()->withInput($request->all())->withErrors($validated->errors());

        //get client photo  name
        $imageName = $request->file('photo')->getClientOriginalName();

        //put photo file to storage folder
        Storage::disk('public')->putFileAs('img', $request->file('photo'), $imageName);

        //call artisan to link storage folder to public folder
        Artisan::call('storage:link', [] );
        $UserID = Auth::user()->Username;
        try{
            $pizza = $this->pizzaBuilder($request->all(), $imageName, $UserID, false);
            $pizza->save();
            return redirect('/add')->with('status',"Pizza added successfully!");
        }
        catch(Exception $e){
            return redirect('/add')->with('failed',"Error occured when saving Pizza..");
        }
    }

    //this function is used for get pizza detail and send it to pizza detail view
    public function pizzaDetail($UserID,$id){
        $pizza = Pizza::where([['id',$id],['AuditActivity','<>','D']])->first();

        return view('master/Pizza/Detail',compact('pizza','UserID'));
    }

    //this function is used for get pizza detail and send it to pizza detail view for guest
    public function pizzaDetailGuest($id){
        $pizza = Pizza::where([['id',$id],['AuditActivity','<>','D']])->first();

        return view('master/Pizza/Detail',compact('pizza'));
    }

    public function pizzaUpdateView($id){
        $pizza = Pizza::where([['id',$id],['AuditActivity','<>','D']])->first();

        return view('master/Pizza/UpdatePizza',['pizza'=>$pizza]);
    }

    //this function is for updating pizza data and save it to db
    public function pizzaUpdate($id, Request $request){
        //get the pizza
        $pizza = Pizza::where([['id',$id],['AuditActivity','<>','D']])->first();

        //first validate the user request form
        $validated = $this->validateRequest($request);

        //if user request form invalid, then redirect to previous page with error detail
        if ($validated->fails()) return redirect()->back()->with('pizza',$pizza->all())->withErrors($validated->errors());

        //get client photo  name
        $imageName = $request->file('photo')->getClientOriginalName();

        //put photo file to storage folder
        Storage::disk('public')->putFileAs('img', $request->file('photo'), $imageName);

        //call artisan to link storage folder to public folder
        Artisan::call('storage:link', [] );
        $UserID = Auth::user()->Username;
        try{
            $pizza = $this->updatePizza($pizza, $request->all(), $imageName, $UserID, true);
            $pizza->save();
            return redirect('/update/'.$id)->with('status',"Pizza updated successfully!");
        }
        catch(Exception $e){
            return redirect('/update/'.$id)->with('failed',"Error occured when saving Pizza..");
        }
    }

    public function deleteView($id){
        $pizza = Pizza::where([['id',$id],['AuditActivity','<>','D']])->first();

        return view('master/Pizza/Delete',['pizza'=>$pizza]);
    }

    //this function is used for delete pizza, we use soft delete
    public function delete($id){
        $auditTime = Carbon::now();
        $pizza = Pizza::where([['id',$id],['AuditActivity','<>','D']])->first();
        $pizza->AuditUsername = Auth::user()->Username;
        $pizza->AuditTime = $auditTime->toDateTimeString();;
        $pizza->AuditActivity = 'D';
        $pizza->save();
        return redirect('/')->with('pizzaDeleted', "Pizza deleted Succesfully!");
    }
}
