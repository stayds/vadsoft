<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Deptmeasure;
use App\Models\Deptstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Charts\UserChart;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }

    public function index(Request $request){
        $user = $this->getUser();
        if($user->organid == 1){
            $dept = Department::all(['id','name']);
        }
        else{
            $dept = Department::where('organisationid', $user->organid)->get(['id','name']);
        }


        if($request->ajax()){

            $deptx = Deptmeasure::with(['deptstates'=>function($query){
                                    $query->select('id','measureid')
                                        ->with(['deptstatehistories'=>function($query){
                                            $query->select('id','deptstateid','kpi')
                                                ->get(['id','deptstatid','kpi']);
                                        }])
                                        ->get(['id','deptid']);
                                }])
                                ->where('deptid',$request->deptid)
                                ->where('next_entry','!=',null)
                                ->where('next_entry','!=',null)
                                ->get(['id']);



            if($deptx->count() > 0){
                $prod_index = 0;
                $count = 0;
                foreach($deptx as $list){
                    foreach($list->deptstates as $lists){
                        foreach($lists->deptstatehistories as $data){
                            ++$count;
                            $prod_index += $data->kpi;
                        }
                    }
                }

                $prod_index = $prod_index/$count;
                $department = Department::find($request->deptid);
                $deptstaff = $department->users()->count();
                $kpi = $deptx->count();
                $name = $department->name;
                $check=true;
            }
            else{
                $check = false;
            }

//            $usersChart = new UserChart;
//            $usersChart->labels(['Jan', 'Feb', 'Mar']);
//            $usersChart->dataset('Users by trimester', 'line', [10, 25, 13]);

            return view('report.dept.report', compact('check','prod_index','deptstaff','kpi','name'));
        }

        return view('report.dept.index',compact('dept'));

    }

    public function getUser(){
        return Auth::user();
    }

}
