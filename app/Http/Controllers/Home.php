<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\employee;
use App\Models\crop;
use App\Models\harvest_inflow;
use App\Models\harvest_outflow;
use App\Models\income;
use App\Models\expence;
use Carbon\Carbon;
use laravel\Eloquent;

class Home extends Controller
{
  function FormEmployee(){
      $data = crop::get();
      $year = Carbon::now()->year;
      $month =Carbon::now()->month;
      $data2 = harvest_inflow::select([DB::raw('sum(amount) as amount'),'crop_name',DB::raw('Year(created_at) as year'),DB::raw('Month(created_at) as month')])
      ->groupby('crop_name','year','month')
      ->having('year','like',$year)
      ->having('month','like',$month)
      ->get();
      return view('user.welcome',['crops'=>$data,'data'=>$data2]);
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
  
public function GetEmployees(){
    $success = false;
    $data = employee::orderby('id','desc')->get();
    return view('user.employee',['employees' =>$data,'success'=>$success]);
}

function GetMaleEmployees(){
    $success =false;
    $data = employee::where('gender','Male')->orderby('id','desc')->get();
    return view('user.employee',['employees' =>$data,'success'=>$success]);
}

function GetFemaleEmployees(){
    $success =false;
    $data = employee::where('gender','female')->orderby('id','desc')->get();
    return view('user.employee',['employees' =>$data,'success'=>$success]);
}

function DeleteEmployees($id){
    $data= employee::find($id);
    $data->delete();
    return redirect()->action([Home::class, "GetEmployees"]);
}

function EditEmployee($id){
    $success =false;
    $data2= employee::find($id);
    $data = employee::orderby('id','desc')->get();
    return view('user.editEmployee',['employee' =>$data2,'employees' =>$data,'success'=>$success]);
}

function Update(Request $data){

    $data->validate([
        'name'=>'required',
        'gender'=>'required'
    ]);

    $employee= employee::find($data->id);
    $employee->name=$data->name;
    $employee->gender=$data->gender;
    $employee->address=$data->address;
    $employee->number=$data->number;
    $employee->nic=$data->nic;
    $employee->notes=$data->notes;
    $employee->updated_at=Carbon::now();
    $employee->save();
    return redirect()->action([Home::class, "GetEmployees"]);
}

function CropsInfo(){
    $data = crop::get();
    $date = Carbon::today();
    $data2 = harvest_inflow::where('created_at',$date)->orderby('id','desc')->get();
    $data3 = harvest_outflow::where('created_at',$date)->orderby('id','desc')->get();
    return view('user.crops',['crops'=>$data,'inflows'=>$data2,'outflows'=>$data3]);
}


function AddCrop(Request $data){
    $data->validate([
        'category'=>'required'
    ]);
   
    $crop = new crop();
    $crop->name=$data->category;
    $crop->created_at=Carbon::now();
    $crop->updated_at=Carbon::now();
    $crop->save();
    return redirect()->action([Home::class, "CropsInfo"]);
}

function DeleteCrop($id){
    $data= crop::find($id);
    $data->delete();
    return redirect()->action([Home::class, "CropsInfo"]);
}

function HarvestInflow(Request $data){
    $rules =[
        'name'=>'required',
        'inflow'=>'required'
    ];
   
$messages =[
    'required'=> 'This field is required'
];
$this->validate($data,$rules,$messages);

    $inflow = new harvest_inflow();
    $inflow->amount=$data->inflow;
    $inflow->crop_name=$data->name;
    $inflow->created_at=Carbon::today();
    $inflow->updated_at=Carbon::today();
    $inflow->save();
    return redirect()->action([Home::class, "CropsInfo"]);
}

function HarvestOutflow(Request $data){
    $rules=[
        'crop_name'=>'required',
        'outflow'=>'required'
    ];

    $messages =[
        'required'=> 'This field is required'
    ];
    $this->validate($data,$rules,$messages);
   
    $outflow = new harvest_outflow();
    $outflow->amount=$data->outflow;
    $outflow->crop_name=$data->crop_name;
    $outflow->created_at=Carbon::today();
    $outflow->updated_at=Carbon::today();
    $outflow->save();
    return redirect()->action([Home::class, "CropsInfo"]);
}

function Editinflow($id){
    $data = crop::get();
    $date = Carbon::today();
    $data4= harvest_inflow::find($id);
    $data2 = harvest_inflow::where('created_at',$date)->orderby('id','desc')->get();
    $data3 = harvest_outflow::where('created_at',$date)->orderby('id','desc')->get();
    return view('user.editinflow',['inflow'=>$data4,'crops'=>$data,'inflows'=>$data2,'outflows'=>$data3]);
}

function EditOutflow($id){
    $data = crop::get();
    $date = Carbon::today();
    $data4= harvest_outflow::find($id);
    $data2 = harvest_inflow::where('created_at',$date)->orderby('id','desc')->get();
    $data3 = harvest_outflow::where('created_at',$date)->orderby('id','desc')->get();
    return view('user.editoutflow',['outflow'=>$data4,'crops'=>$data,'inflows'=>$data2,'outflows'=>$data3]);
}

function UpdateHarvestInflow(Request $data){
    $rules =[
        'name'=>'required',
        'inflow'=>'required'
    ];
   
$messages =[
    'required'=> 'This field is required'
];
$this->validate($data,$rules,$messages);

    $inflow = harvest_inflow::find($data->id);
    $inflow->amount=$data->inflow;
    $inflow->crop_name=$data->name;
    $inflow->updated_at=Carbon::today();
    $inflow->save();
    return redirect()->action([Home::class, "CropsInfo"]);
}

function UpdateHarvestOutflow(Request $data){
    $rules=[
        'crop_name'=>'required',
        'outflow'=>'required'
    ];

    $messages =[
        'required'=> 'This field is required'
    ];
    $this->validate($data,$rules,$messages);
   
    $outflow = harvest_outflow::find($data->id);
    $outflow->amount=$data->outflow;
    $outflow->crop_name=$data->crop_name;
    $outflow->updated_at=Carbon::today();
    $outflow->save();
    return redirect()->action([Home::class, "CropsInfo"]);
}



function DeleteInflow($id){
    $data= harvest_inflow::find($id);
    $data->delete();
    return redirect()->action([Home::class, "CropsInfo"]);
}

function DeleteOutflow($id){
    $data= harvest_outflow::find($id);
    $data->delete();
    return redirect()->action([Home::class, "CropsInfo"]);
}

function CropsIncome(){
    $data = crop::get();
    $data2 = income::where('created_at',Carbon::today())->get();
    return view('user.income',['crops'=>$data,'incomes'=>$data2]);
}

function CropsExpence(){
    $data = crop::get();
    $data2 = expence::where('created_at',Carbon::today())->get();
    return view('user.expences',['crops'=>$data,'expences'=>$data2]);
}

function EditIncome($id){
    $data = crop::get();
    $data2 = income::where('created_at',Carbon::today())->get();
    $data3 = income::find($id);
    return view('user.editincome',['income'=>$data3,'crops'=>$data,'incomes'=>$data2]);
}

function EditExpence($id){
    $data = crop::get();
    $data2 = expence::where('created_at',Carbon::today())->get();
    $data3 = expence::find($id);
    return view('user.editexpence',['expence'=>$data3,'crops'=>$data,'expences'=>$data2]);
}


function AddCropsIncome(Request $data){
    $data->validate([
        'category'=>'required',
        'amount'=>'required',
        'description'=>'required'
    ]);

    $inflow = new income();
    $inflow->amount=$data->amount;
    $inflow->category=$data->category;
    $inflow->description=$data->description;
    $inflow->created_at=Carbon::today();
    $inflow->updated_at=Carbon::today();
    $inflow->save();
    return redirect()->action([Home::class, "CropsIncome"]);
}

function AddCropsExpence(Request $data){
    $data->validate([
        'category'=>'required',
        'amount'=>'required',
        'description'=>'required'
    ]);
   
    $outflow = new expence();
    $outflow->amount=$data->amount;
    $outflow->category=$data->category;
    $outflow->description=$data->description;
    $outflow->created_at=Carbon::today();
    $outflow->updated_at=Carbon::today();
    $outflow->save();
    return redirect()->action([Home::class, "CropsExpence"]);
}

function DeleteIncome($id){
    $data= income::find($id);
    $data->delete();
    return redirect()->action([Home::class, "CropsIncome"]);
}

function DeleteExpence($id){
    $data= expence::find($id);
    $data->delete();
    return redirect()->action([Home::class, "CropsExpence"]);
}

function UpdateCropsIncome(Request $data){
    $data->validate([
        'category'=>'required',
        'amount'=>'required',
        'description'=>'required'
    ]);

    $inflow = income::find($data->id);
    $inflow->amount=$data->amount;
    $inflow->category=$data->category;
    $inflow->description=$data->description;
    $inflow->created_at=Carbon::today();
    $inflow->updated_at=Carbon::today();
    $inflow->save();
    return redirect()->action([Home::class, "CropsIncome"]);
}

function UpdateCropsExpence(Request $data){
    $data->validate([
        'category'=>'required',
        'amount'=>'required',
        'description'=>'required'
    ]);
   
    $outflow = expence::find($data->id);
    $outflow->amount=$data->amount;
    $outflow->category=$data->category;
    $outflow->description=$data->description;
    $outflow->created_at=Carbon::today();
    $outflow->updated_at=Carbon::today();
    $outflow->save();
    return redirect()->action([Home::class, "CropsExpence"]);
}




}
