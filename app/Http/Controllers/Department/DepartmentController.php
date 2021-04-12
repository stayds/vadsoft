<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Organisation;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }

    public function index()
    {
        $user = $this->getUser();
//        if($user->isdev || $user->roleid == 2){
//            $depts = Department::selectRaw('departments.id,COUNT(DISTINCT department_user.user_id) as staff')
//                ->selectRaw('departments.description,states.name as state,departments.name as dept, departments.status')
//                ->leftJoin('department_user','departments.id','=','department_user.department_id')
//                ->leftJoin('states','states.id','=','departments.stateid')
//                // ->leftJoin('units','departments.id','=','units.deptid')
//                ->where('departments.organisationid', $user->organid)
//                ->groupBy('departments.id')
//                ->paginate(10);
//        }
//        else{
            $depts = Department::selectRaw('departments.id,departments.status,COUNT(DISTINCT department_user.user_id) as staff')
                ->selectRaw('departments.description,states.name as state,departments.name as dept')
                ->leftJoin('department_user','departments.id','=','department_user.department_id')
                ->leftJoin('states','states.id','=','departments.stateid')
                // ->leftJoin('units','departments.id','=','units.deptid')
                ->where('departments.organisationid', $user->organid)
                ->groupBy('departments.id')
                ->paginate(10);
        //}

        return view('department.list',compact('depts'));
    }


    public function create()
    {
        $states = State::all(['id','name']);
        $user = $this->getUser();

        if($user->organid == 1){
            $org = Organisation::where('status',true)->get(['id','name']);
        }
        return view('department.create', compact('states','org'));
    }


    public function store(Request $request)
    {
        $user = $this->getUser();
        if($user->organid == 1){
            $rules = [
                'name' => 'required|min:3',
                'description' => 'required|min:6|string',
                'stateid' => 'required',
                'organid' => 'required',
                'address' => 'required|min:6|string',
            ];
        }else{
            $rules = [
                'name' => 'required|min:3',
                'description' => 'required|min:6|string',
                'stateid' => 'required',
                'address' => 'required|min:6|string',
            ];
        }


        $this->validate($request, $rules);

        $department = new Department();
        $department->organisationid = ($user->organid == 1) ? $request->organid : $user->organid;
        $department->name = $request->name;
        $department->description = $request->description;
        $department->address = $request->address;
        $department->stateid = $request->stateid;
        $department->save();

        return redirect()->back()->withSuccess('Department Successfully Created');

    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        dd($id);
        $dept = Department::find($id);

        if($dept){

            $dept->status = $dept->status == 1 ? 0 : 1;
            $dept->save();

            return redirect()->back()->withSuccess('Department Successfully Updated');

        }

        return redirect()->back()->withErrors('Department not updated');

    }

    public function setSupervisor(Request $request){
        $user = $this->getUser();
        $dept = Department::where(["organisationid"=>$user->organid,'status'=>true])->get(['id','name']);

        if($request->ajax()){

            $depts = Department::selectRaw('userprofiles.fname,userprofiles.lname, users.id')
                ->leftJoin('department_user','departments.id','=','department_user.department_id')
                ->leftJoin('users','department_user.user_id','=','users.id')
                ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
                ->where('departments.id',$request->deptid)
                ->get();

            return response()->json($depts);
        }

        return view('department.setsupervisor', compact('dept'));
    }

    public function setSupervisorPost(Request $request){
        $rules = [
            'deptid' => 'required',
            'userid' => 'required',
        ];

        $this->validate($request, $rules);

        Department::find($request->deptid)->users()->updateExistingPivot($request->userid, ['supervisor'=>true]);

        return redirect()->back()->withSuccess('Staff Set as Supervisor');
    }

    public function getSupervisor()
    {
        $user = $this->getUser();
        $department = Department::selectRaw('departments.id,users.id as userid,departments.name,userprofiles.gender,userprofiles.fname,userprofiles.lname,userprofiles.jobtitle,userprofiles.gradelevel,userprofiles.staffno')
            ->leftJoin('department_user', 'departments.id', '=', 'department_user.department_id')
            ->leftJoin('users', 'department_user.user_id', '=', 'users.id')
            ->leftJoin('userprofiles', 'users.id', '=', 'userprofiles.userid')
            ->where(['department_user.supervisor'=> true, 'departments.organisationid'=>$user->organid])
            ->paginate(10);

        return view('department.supervisorlist',compact('department'));
    }

    public function disableSupervisor(Request $request){
        Department::find($request->id)->users()->updateExistingPivot($request->userid, ['supervisor'=>0]);
        return redirect()->back()->withSuccess('Staff Set as Supervisor');
    }

    private function getUser(){
        return Auth::user();
    }
}
