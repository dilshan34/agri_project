<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\employee;
use Carbon\Carbon;

class Home extends Controller
{
  function FormEmployee(){
      $success =false;
      return view('welcome',['success'=>$success]);
  }

   function AddEmployee(Request $data){

        $data->validate([
            'name'=>'required',
            'gender'=>'required'
        ]);

        $employee = new employee();
        $employee->name=$data->name;
        $employee->gender=$data->gender;
        $employee->address=$data->address;
        $employee->number=$data->number;
        $employee->nic=$data->nic;
        $employee->notes=$data->notes;
        $employee->created_at=Carbon::now();
        $employee->updated_at=Carbon::now();
        $employee->save();

        $data = employee::orderby('id','desc')->get();
        return view('employee',['employees' =>$data,'success'=>true]);
    }
  
public function GetEmployees($success = false){
    $data = employee::orderby('id','desc')->get();
    return view('employee',['employees' =>$data,'success'=>$success]);
}

function GetMaleEmployees(){
    $success =false;
    $data = employee::where('gender','Male')->orderby('id','desc')->get();
    return view('employee',['employees' =>$data,'success'=>$success]);
}

function GetFemaleEmployees(){
    $success =false;
    $data = employee::where('gender','female')->orderby('id','desc')->get();
    return view('employee',['employees' =>$data,'success'=>$success]);
}

function DeleteEmployees($id){
    $data= employee::find($id);
    $data->delete();
    return redirect()->action([Home::class, "GetEmployees"]);
}



}
