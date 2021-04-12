<?php

namespace App\Http\Controllers\Auth;

use App\Mail\EmailVerify;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Deptuser;
use App\Models\Organisation;
use App\Models\Role;
use App\Models\User;
use App\Models\Userprofile;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Client a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegistrationForm(Request $request)
    {
        $gender = ['Female','Male'];
        $user = Auth::user();
        $dept = Department::where(['organisationid'=>$user->organid,'status'=>true])->get(['id','name']);
//        $role = Role::where('status',true)
//                      ->where('id','!=',2)->get(['id','name']);
        $staff = $this->getUser();
        if($staff->organid == 1){
            $org = Organisation::where('id','!=',1)->get();
        }


        if ($request->ajax()){
            $dept = Department::where('organisationid',$request->id)->get();
            if($dept->count() > 0){
                return response()->json($dept,200);
            }
            return response()->json('No record exist',403);
        }
        return view('auth.register',compact('dept','gender','org'));
    }

    protected function validator(array $data)
    {
        $staff = $this->getUser();
        if ($staff->organid == 1){
            return Validator::make($data, [
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:11','min:8', 'unique:users'],
                'staffno' => ['required','string','unique:userprofiles'],
                'gender' => ['required'],
                'jobtitle' => ['required'],
                'departmentid' => ['required'],
                'organid' => ['required'],
                'gradelevel' => ['required'],
                'receive' => ['required'],
            ]);
        }
        else{
            return Validator::make($data, [
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:11','min:8', 'unique:users'],
                'staffno' => ['required','string','unique:userprofiles'],
                'gender' => ['required'],
                'jobtitle' => ['required'],
                'departmentid' => ['required'],
                'gradelevel' => ['required'],
                'receive' => ['required'],
            ]);
        }

    }


    protected function create(array $data)
    {
        $staff = $this->getUser();
        $user = User::create([
            'email' => $data['email'],
            'name' => $data['fname'],
            'phone' => $data['phone'],
            'clientid' => 1,
            'organid' => ($staff->organid == 1) ? $data['organid'] : $staff->organid,
            'roleid' => 4,
            'isdev' => false,
            'password' => Hash::make('pa55word@1'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        //create User profile record
        $profile = new Userprofile();

        $profile->userid = $user->id;
        $profile->fname = $data['fname'];
        $profile->lname = $data['lname'];
        $profile->jobtitle = $data['jobtitle'];
        $profile->jobdesc = $data['jobdesc'];
        $profile->staffno = $data['staffno'];
        $profile->gender = $data['gender'];
        $profile->gradelevel = $data['gradelevel'];
        $profile->save();

        //attach staff to department
        $user->departments()->attach($data['departmentid'],['receive'=>$data['receive']]);
        //attaching roles
        //$user->roles()->attach(1);

        //return your object
        return $user;
        //return redirect()->back()->withSuccess('Staff Record Successfully Created');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

       // $this->guard()->login($user);

        //return $this->registered($request, $user)
          //  ?: redirect($this->redirectPath());
        return redirect()->back()->withSuccess('Staff Record Successfully Created');
    }

    private function getUser(){
        return Auth::user();
    }
}
