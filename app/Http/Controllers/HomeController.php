<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Deptstate;
use App\Models\Deptstatehistory;
use App\Models\Organisation;
use App\Models\Staffstate;
use App\Models\Staffstatehistory;
use App\Models\Unit;
use App\Models\Unitstate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }


    public function index()
    {
        $user = $this->getUser();
        if ($user->roleid == 2){
            $staff = User::where('isdev',false)->get(['id']);
            $dept = Department::where('status',true)->get(['id']);
            $unit = Unit::where('status',true)->get(['id']);
            $organx = Organisation::where(['status'=>true])->get(['id']);

        }
        else{
            $staff = User::where(['isdev'=>false,'organid'=>$user->organid])->get(['id']);
            $dept = Department::where(['status'=>true, 'organisationid'=>$user->organid])->get(['id']);
            $unit = Unit::where(['status'=>true,'organid'=>$user->organid])->get(['id']);
            //$organ = Organisation::where(['status'=>true,'id'=>$user->organid])->get(['id']);
            $organx = null;

        }

          $staffnotice = $this->staff($user->id, $user->organid);
          $deptnotice = $this->department($user->id, $user->organid);
//        $unitnotice = $this->unit($user->id);
          $supervisorstaff = $this->supervisorStaff($user);
          $supervisordept = $this->supervisorDept($user);
//        $supervisorunit = $this->unitsuper();

        return view('home.dashboard', compact('staff','organx','dept','supervisordept','supervisorstaff','unit','staffnotice','deptnotice'));
    }

    private function getUser(){
        return auth()->user();
    }

    private function staff($id, $organid){

        return Staffstate::selectRaw('staffstates.id,staffmeasures.organid,staffmeasures.next_entry,staffstates.question_effy,staffstates.question_effv,staffstates.created_at')
            ->selectRaw('staffstatehistories.approve_effv,staffstatehistories.approve_effy')
            ->leftJoin('staffmeasures','staffstates.measureid','=','staffmeasures.id')
            ->leftJoin('staffstatehistories','staffstates.id','=','staffstatehistories.staffstateid')
            //->leftJoin('users','staffmeasures.userid','=','users.id')
            ->where('staffmeasures.organid',$organid)
            ->where('staffmeasures.userid', $id)
            //->where(['staffmeasures.next_entry'=> null])
            //->orwhere('staffmeasures.next_entry','<', Carbon::today())
            ->get();
    }

    private function department($id, $organid){

        return Deptstate::selectRaw('deptstates.id,deptmeasures.next_entry,deptstates.question_effy,deptstates.question_effv,deptstates.created_at')
            ->selectRaw('deptstatehistories.approve_effv,deptstatehistories.approve_effy')
            ->leftJoin('deptmeasures','deptstates.measureid','=','deptmeasures.id')
            ->leftJoin('deptstatehistories','deptstates.id','=','deptstatehistories.deptstateid')
            ->leftJoin('users','deptmeasures.userid','=','users.id')
            ->where('users.id', $id)
            ->where('deptmeasures.next_entry', null)
            ->where('deptmeasures.organid', $organid)
            //->orwhere('deptmeasures.next_entry','<', Carbon::today())
            ->get();
    }

    private function unit($id){

        return Unitstate::selectRaw('unitstates.id,unitstates.routine,unitstates.next_entry,unitstates.created_at,measuretypes.name')
            ->leftJoin('users','users.id','=','unitstates.userid')
            ->leftJoin('measuretypes','measuretypes.id','=','unitstates.measuretypeid')
            ->where('users.id', $id)
            ->where('unitstates.next_entry', null)
            ->orwhere('unitstates.next_entry','<', Carbon::today())
            ->get();
    }

    private function supervisorDept($user){

        return Deptstatehistory::selectRaw('departments.name,deptstates.measureid,deptstatehistories.created_at,deptstatehistories.id')
            ->leftJoin('users','users.id','=','deptstatehistories.supervisorid')
            ->leftJoin('department_user','department_user.user_id','=','users.id')
            ->leftJoin('departments','department_user.department_id','=','departments.id')
            ->leftJoin('deptstates','deptstatehistories.deptstateid','=','deptstates.id')
            ->where('deptstatehistories.supervisorid', $user->id)
            ->where('deptstatehistories.approve_effy',0)
//            ->where('unitstates.next_entry', null)
//            ->orwhere('unitstates.next_entry','<', Carbon::today())
            ->get();

    }

    private function supervisorStaff($user){

        return Staffstatehistory::selectRaw('userprofiles.fname,userprofiles.lname,staffstates.measureid,staffstatehistories.created_at,staffstatehistories.id')
            ->leftJoin('users','users.id','=','staffstatehistories.supervisorid')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->leftJoin('department_user','department_user.user_id','=','users.id')
            ->leftJoin('departments','department_user.department_id','=','departments.id')
            ->leftJoin('staffstates','staffstatehistories.staffstateid','=','staffstates.id')
            ->where('staffstatehistories.supervisorid', $user->id)
            ->where('staffstatehistories.approve_effy',0)
//            ->where('unitstates.next_entry', null)
//            ->orwhere('unitstates.next_entry','<', Carbon::today())
            ->get();

    }

}
