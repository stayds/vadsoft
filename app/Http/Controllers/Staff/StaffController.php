<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Deptuser;
use App\Models\User;
use App\Models\Userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }

    public function index()
    {

        $user = $this->getUser();

//        if($user->isdev || $user->roleid == 2) {
//
//            $staff = User::selectRaw("users.id,users.status,users.email,users.created_at,states.name as state,userprofiles.jobtitle,departments.name as dept")
//                ->selectRaw('userprofiles.fname,userprofiles.lname,userprofiles.staffno,userprofiles.gradelevel,userprofiles.gender')
//                ->leftJoin('userprofiles', 'users.id', '=', 'userprofiles.userid')
//                ->leftJoin('department_user', 'users.id', '=', 'department_user.user_id')
//                ->leftJoin('departments', 'department_user.department_id', '=', 'departments.id')
//                ->leftJoin('states', 'departments.stateid', '=', 'states.id')
//                ->where(['users.isdev' => 0])
//                ->orderBy('users.created_at', 'DESC')
//                ->paginate(10);
//        }
//        else{
            $staff = User::selectRaw("users.id,users.status,users.email,users.created_at,states.name as state,userprofiles.jobtitle,departments.name as dept")
                ->selectRaw('userprofiles.fname,userprofiles.lname,userprofiles.staffno,userprofiles.gradelevel,userprofiles.gender')
                ->leftJoin('userprofiles', 'users.id', '=', 'userprofiles.userid')
                ->leftJoin('department_user', 'users.id', '=', 'department_user.user_id')
                ->leftJoin('departments', 'department_user.department_id', '=', 'departments.id')
                ->leftJoin('states', 'departments.stateid', '=', 'states.id')
                ->where(['users.isdev' => 0, 'users.organid' => $user->organid])
                ->orderBy('users.created_at', 'DESC')
                ->paginate(10);
        //}
        return view('staff.stafflist', compact('staff'));
    }


    public function create()
    {
        return view('create.staff');
    }


    public function store(Request $request)
    {

    }


    public function show()
    {
        $user = $this->getUser();

        $staff = User::selectRaw("users.phone,users.email,users.created_at,states.name as state,userprofiles.jobtitle,departments.name as dept")
            ->selectRaw('userprofiles.fname,userprofiles.lname,userprofiles.staffno,userprofiles.gradelevel,userprofiles.gender')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->leftJoin('department_user','users.id','=','department_user.user_id')
            ->leftJoin('departments','department_user.department_id','=','departments.id')
            ->leftJoin('states','departments.stateid','=','states.id')
            ->where('users.id', $user->id)
            ->first();

        return view('staff.profile',compact('staff'));
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {

        $rules = [
            'fname' => 'required|min:3',
            'lname' => 'required|min:3',
            'staffno' => 'required|min:6|string',
            'gradelevel' => 'required|string'
        ];

        $validator = Validator::make($request->except('_token'), $rules);

        if ($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }


        $user = $this->getUser();

        $profile = $user->userprofile;

        $profile->fname = $request->fname;
        $profile->lname = $request->lname;
        $profile->staffno = $request->staffno;
        $profile->gradelevel = $request->gradelevel;

        $profile->save();

        return redirect()->back()->withSuccess('Record Successfully Updated');

    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user){
            $user->status = ($user->status > 0) ? 0 : 1;
            $user->save();
            return redirect()->back()->withSuccess('Staff status successfully updated');
        }

        return redirect()->back()->withSuccess('Staff status was not updated');
    }

    public function setSupervisor(){
        $user = $this->getUser();
        $staff = User::selectRaw('users.id,userprofiles.fname,userprofiles.lname')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->where('users.isdev',false)

            ->get();

       return view('staff.supervisor', compact('staff'));
    }

    public function setSupervisorPost(Request $request){
        $rules = [
            'userid' => 'required',
        ];

        $this->validate($request, $rules);

        $staff = User::find($request->userid);
        $staff->supervisor = true;
        $staff->save();

        return redirect()->back()->withSuccess('Record Set as Staff Supervisor');
    }

    private function getUser(){
        return Auth::user();
    }

    public function getSupervisor()
    {
        $user = $this->getUser();
        $staff = User::selectRaw('userprofiles.id,users.created_at,userprofiles.gender,userprofiles.fname,userprofiles.lname,userprofiles.staffno,userprofiles.gradelevel,userprofiles.jobtitle')
            ->leftJoin('userprofiles', 'users.id', '=', 'userprofiles.userid')
            ->where('users.supervisor', '=', 1)
            ->where('users.organid',$user->organid)
            ->paginate(10);

        return view('staff.supervisorlist',compact('staff'));
    }

    public function disableSupervisor(Request $request){
        $user = Userprofile::find($request->id);
        $user->supervisor = 0;
        $user->save();

        return redirect()->back();
    }

    public function changePassword(){
        return view('staff.changepassword');
    }

    public function changePasswordPost(Request $request){

        $rules = [
            'password' => 'required|confirmed|min:6'
        ];

        $this->validate($request, $rules);

        $user = $this->getUser();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->withSuccess('User Password has been Changed');

    }

}
