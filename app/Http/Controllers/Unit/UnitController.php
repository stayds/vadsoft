<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Unit;
use App\Models\Unituser;
use App\Models\User;
use Carbon\Traits\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }

    public function index()
    {
        $user = $this->getUser();

        $units = Unit::selectRaw(DB::Raw('COUNT(unit_user.user_id) as user,units.name as unit,units.description,units.created_at,units.status,departments.name as dept'))
            ->leftJoin('departments','units.deptid','=','departments.id')
            ->leftJoin('unit_user','units.id','=','unit_user.unit_id')
            ->where('units.organid',$user->organid)
            ->groupBy('units.id')
            ->paginate(10);

        return view('unit.list',compact('units'));
    }


    public function create()
    {
        $user = $this->getUser();

//        if($user->organid == 1){
//            $dept = Department::where('status',true)->get(['id','name']);
//        }else{
            $dept = Department::where('organisationid',$user->organid)->get(['id','name']);
        //}

        return view('unit.create',compact('dept'));
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:6|string',
            'deptid' => 'required'
        ];

        $this->validate($request, $rules);

        $unit = new Unit();
        $dept = Department::find($request->deptid);

        $unit->deptid = $request->deptid;
        $unit->organid = $dept->organisationid;
        $unit->status = 1;
        $unit->name = $request->name;
        $unit->description = $request->description;

        $unit->save();

        return redirect()->back()->withSuccess('Unit Successfully Created');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {
        //
    }

    public function addStaff(){

        $staff = User::selectRaw('users.id,userprofiles.fname,userprofiles.lname')
                    ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
                    ->where([ 'users.isdev'=> false, 'users.status'=>true])
                    ->get();

        $units = Unit::where('status',true)->get(['id','name']);
        $receive = ['No'=>0, 'yes'=>1];

        return view('unit.assignstaff', compact('staff','units','receive'));

    }

    //post for adding staff to a unit
    public function setStaffPost(Request $request){
        $rules = [
            'unitid' => 'required',
            'userid' => 'required',
            'receive' => 'required',
        ];

        $this->validate($request, $rules);
        $unit = Unit::find($request->unitid);

        $unit->users()->attach($request->userid,['receive'=>$request->receive]);

        return redirect()->back()->withSuccess('Staff added to Unit');
    }

    public function setSupervisor(Request $request){

        $unit = Unit::where('status',true)->get(['id','name']);

        if($request->ajax()){

            $user = Unit::selectRaw('userprofiles.fname,userprofiles.lname,users.id')
                ->leftJoin('unit_user','units.id','=','unit_user.unit_id')
                ->leftJoin('users','unit_user.user_id','=','users.id')
                ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
                ->where('units.id',$request->unitid)
                ->get();

            return response()->json($user);
        }

        return view('unit.supervisor', compact('unit'));
    }

    public function setSupervisorPost(Request $request){
        $rules = [
            'unitid' => 'required',
            'userid' => 'required',
        ];

        $this->validate($request, $rules);

        $unit = Unit::find($request->unitid);

        $unit->users()->updateExistingPivot($request->userid,['receive'=>true]);

        return redirect()->back()->withSuccess('Staff Set as Unit Supervisor');
    }

    public function getSupervisor(){

        $unit = Unit::selectRaw('units.name as unit,departments.name,userprofiles.fname,userprofiles.lname,userprofiles.jobtitle,userprofiles.gradelevel,userprofiles.staffno')
            ->leftJoin('unit_user','units.id','=','unit_user.unit_id')
            ->leftJoin('users','unit_user.user_id','=','users.id')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->leftJoin('departments','units.deptid','=','departments.id')
            ->where('unit_user.receive',true)
            ->paginate(10);

        return view('unit.supervisorlist',compact('unit'));
    }

    public function disableSupervisor(Request $request){
        Unit::find($request->id)->users()->updateExistingPivot($request->userid, ['receive'=>0]);
        return redirect()->back();
    }

    private function getUser(){
        return Auth::user();
    }

}
