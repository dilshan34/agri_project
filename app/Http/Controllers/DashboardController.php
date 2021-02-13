<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\employee;
use App\Models\crop;
use App\Models\harvest_inflow;
use App\Models\harvest_outflow;
use App\Models\income;
use App\Models\expence;
use Carbon\Carbon;
use laravel\Eloquent;

class DashboardController extends Controller
{
    public function index(){

        if(Auth::user()->hasRole('user'))
        {

            $data = crop::get();
            $year = Carbon::now()->year;
            $month =Carbon::now()->month;
            $data2 = harvest_inflow::select([DB::raw('sum(amount) as amount'),'crop_name',DB::raw('Year(created_at) as year'),DB::raw('Month(created_at) as month')])
            ->groupby('crop_name','year','month')
            ->having('year','like',$year)
            ->having('month','like',$month)
            ->get();
            return view('user.welcome',['crops'=>$data,'data'=>$data2]);     
                 
           // return view('user.dashboard');

        }

        elseif(Auth::user()->hasRole('admin'))
        {
            return view('admin.dashboard');
        }
    }
}
