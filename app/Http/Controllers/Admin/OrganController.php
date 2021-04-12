<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Organisation;
use App\Models\User;
use App\Models\Userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrganController extends Controller
{

    public function __construct()
    {
        $this->middleware(['admin','backinvalidate']);
    }

    public function index()
    {

    }


    public function create()
    {
        $gender = ['female', 'male'];
        return view('admin.organisation.organ', compact('gender'));
    }

    public function store(Request $request)
    {
        $rules = [
            'fname' => 'required|min:3',
            'lname' => 'required|min:3',
            'jobtitle' => 'required|min:3',
            'jobdesc' => 'required|min:3',
            'gradelevel' => 'required|min:3',
            'staffno' => 'required|numeric|unique:userprofiles|min:6',
            'gender' => 'required',
            'phone' => 'required|unique:users|min:11',
            'email' => 'required|unique:users',
            'name' => 'required|min:3'
        ];

        $this->validate($request, $rules);
        $client = Client::find(1);
        $org = new Organisation();
        $org->sectorid = $client->sectorid;
        $org->stateid = $client->stateid;
        $org->name = $request->name;
        $org->parent = true;
        $org->clientid = $client->id;
        $org->address = $client->address;
        $org->save();

        $user = new User();
        $user->clientid = 1;
        $user->organid = $org->id;
        $user->name = $request->fname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make('pa55word@1');
        $user->roleid = 2;
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
        //
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
        //
    }
}
