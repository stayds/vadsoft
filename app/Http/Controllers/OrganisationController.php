<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Deptmeasure;
use App\Models\Organisation;
use App\Models\Sector;
use App\Models\State;
use App\Models\User;
use App\Models\Client;
use App\Models\Userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrganisationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }
    public function index()
    {
//        $org = Organisation::with('state','users')
//                            ->where('id','>',1)
//                            ->where('users.roleid',2)
//                            ->paginate(10);
        $org = Organisation::selectRaw("organisations.*,states.name as state")
            ->leftJoin('states','organisations.stateid','=','states.id')
            ->paginate(10);

        return view('organisation.viewlist',compact('org'));
    }


    public function create()
    {
        $sectors = Sector::all(['id','name']);
        $states = State::all(['id','name']);
        $gender = ['Female','Male'];
        $client = Client::find(1);
        $clientorg = $client->organ;
        $orgcount = Organisation::get()->count();
        return view('organisation.create', compact('sectors','states','gender','orgcount','clientorg'));
    }


    public function store(Request $request)
    {
        $rules = [
            'sectorid' => 'required|numeric',
            'stateid' => 'required|numeric',
            'fname' => 'required|min:3',
            'lname' => 'required|min:3',
            'jobtitle' => 'required|min:3',
            'jobdesc' => 'required|min:3',
            'gradelevel' => 'required|min:3',
            'staffno' => 'required|numeric|unique:userprofiles|min:6',
            'gender' => 'required',
            'phone' => 'required|unique:users|min:11',
            'email' => 'required|unique:users',
            'name' => 'required|min:3',
            'address' => 'required|min:6|string',
        ];

        $this->validate($request, $rules);

        $org = new Organisation();
        $org->sectorid = $request->sectorid;
        $org->stateid = $request->stateid;
        $org->name = $request->name;
        $org->clientid = 1;
        $org->address = $request->address;
        $org->save();

        $user = new User();
        $user->clientid = 1;
        $user->organid = $org->id;
        $user->name = $request->fname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make('pa55word@1');
        $user->roleid = 1;
        $user->isdev = false;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();

        $profile = new Userprofile();
        $profile->userid = $user->id;
        $profile->fname = $request->fname;
        $profile->lname = $request->lname;
        $profile->jobtitle = $request->jobtitle;
        $profile->jobdesc = $request->jobdesc;
        $profile->staffno = $request->staffno;
        $profile->gender = $request->gender;
        $profile->gradelevel = $request->gradelevel;
        $profile->save();

        $user->sendEmailVerificationNotification();

        return redirect()->back()->withSuccess("Organisation Successfully Created");

    }


    public function show($id)
    {
        $org = Organisation::selectRaw("organisations.*,states.name as state,users.email,users.phone,userprofiles.fname,userprofiles.lname,sectors.name as sector")
            ->leftJoin('states','organisations.stateid','=','states.id')
            ->leftJoin('sectors','organisations.sectorid','=','sectors.id')
            ->leftJoin('users','organisations.id','=','users.id')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->where('users.roleid',1)
            ->orwhere('users.roleid',2)
            ->first();
        //$org = Organisation::where('id',$id)->with(['state','sector'])->first();
        return view('organisation.edit',compact('org'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'address' => 'required|min:3',
            'id'=>'required'
        ];

        $this->validate($request, $rules);
        $org = Organisation::find($request->id);
        $org->name = $request->name;
        $org->address = $request->address;
        $org->save();
        return redirect()->back()->withSuccess("Organisation Successfully updated");
    }


    public function destroy($id)
    {
        $org = Organisation::find($id);
        $org->status = ($org->status > 0) ? 0 : 1;

        $org->save();

        return redirect()->back()->withSuccess('Record Successfully Updated');
    }

    public function createSector(){
        return view('create.sector');
    }

    public function createSectorPost(Request $request){
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:6|string',
        ];

        $this->validate($request, $rules);

        $sector = new Sector();
        $sector->name = $request->name;
        $sector->description = $request->description;
        $sector->save();

        return redirect()->back()->withSuccess("Sector Successfully Created");
    }

    public function report(Request $request){

        $user = $this->getUser();

        if($user->organid == 1){
            $organ = Organisation::all(['id','name']);
        }
        else{
            $organ = Department::find($user->organid);
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
                ->where('organid',$request->organid)
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
                $name = Organisation::find($request->organid)->name;
                $deptstaff = User::where('organid',$request->organid)->get('id')->count();
                $kpi = $deptx->count();

                $check=true;
            }
            else{
                $check = false;
            }

            return view('report.organ.report', compact('check','prod_index','deptstaff','kpi','name'));
        }

        return view('report.organ.index',compact('organ'));

    }

    public function getUser(){
        return Auth::user();
    }

}
