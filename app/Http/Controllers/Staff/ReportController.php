<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staffmeasure;
use App\Models\Staffstate;
use App\Models\User;
use App\Models\Userprofile;
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
            $staff = User::all(['id','name']);
        }
        else{
            $staff = User::where('organid', $user->organid)->get(['id','name']);

        }


        if($request->ajax()){

            $userx = Staffmeasure::with(['staffstates'=>function($query){
                $query->select('id','measureid')
                    ->with(['staffstatehistories'=>function($query){
                        $query->select('id','staffstateid','kpi')
                            ->get(['id','staffstateid','kpi']);
                    }])
                    ->get(['id','userid']);
            }])
                ->where('userid',$request->userid)
                ->where('next_entry','!=',null)
                ->get(['id']);

            if($userx->count() > 0){

                $prod_index = 0;
                $count = 0;
                foreach($userx as $list){
                    foreach($list->staffstates as $lists){
                        foreach($lists->staffstatehistories as $data){
                            ++$count;
                            $prod_index += $data->kpi;
                        }
                    }
                }
                $prod_index = $prod_index/$count;
                $user = User::find($request->userid);

                $kpi = $userx->count();

                $profile = $user->userprofile;
                $check=true;
            }
            else{
                $check = false;
            }

            return view('report.staff.report', compact('check','prod_index','deptstaff','kpi','profile'));
        }

        return view('report.staff.index',compact('staff'));

    }

    public function getUser(){
        return Auth::user();
    }


}
