<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Unitstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }

    public function index(Request $request){

        $user = $this->getUser();

        if($user->organid == 1){
            $unit = Unit::all(['id','name']);
        }
        else{
            $unit = Unit::where('organid', $user->organid)->get(['id','name']);
        }


        if($request->ajax()){

            $unitx = Unitmeasure::with(['unitstates'=>function($query){
                $query->select('id','measureid')
                    ->with(['unitstatehistories'=>function($query){
                        $query->select('id','unitstateid','kpi')
                            ->get(['id','unitstatid','kpi']);
                    }])
                    ->get(['id','unitid']);
            }])
                ->where('unitid',$request->unitid)
                ->where('next_entry','!=',null)
                ->get(['id']);

            if($unitx->count() > 0){
                $prod_index = 0;
                $count = 0;
                foreach($unitx as $list){
                    foreach($list->unitstates as $lists){
                        foreach($lists->unitstatehistories as $data){
                            ++$count;
                            $prod_index += $data->kpi;
                        }
                    }
                }
                $prod_index = $prod_index/$count;
                $unit = Unit::find($request->unitid);
                $unitstaff = $unit->users()->count();
                $kpi = $unitx->count();
                $name = $unit->name;
                $check=true;
            }
            else{
                $check = false;
            }

            return view('report.unit.report', compact('check','prod_index','unitstaff','kpi','name'));
        }

        return view('report.unit.index',compact('unit'));

    }

    public function getUser(){
        return Auth::user();
    }
}
