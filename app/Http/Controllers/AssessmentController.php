<?php

namespace App\Http\Controllers;

use App\Models\Assessmenttype;
use App\Models\Deptstate;
use App\Models\Deptefficiency;
use App\Models\Kpi;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }

    public function index()
    {
        $user = $this->getUser();
        if($user->organid == 1){
            $list = Assessmenttype::select('id','title','type')->paginate(10);
        }
        else{
            $list = Assessmenttype::select('id','title','type')->where('organid',$user->organid)->paginate(10);
        }

        return view('assessment.list',compact('list'));
    }


    public function create()
    {
        $type = [
                    "Staff Assessment"=>"staff",
                    "Department Assessment"=>"department",
                    "Unit Assessment"=>"unit"
                ];
        $user = $this->getUser();

        if($user->organid == 1){
            $organ = Organisation::where('status',true)->get(['id','name']);
        }
        else{
            $organ="";
        }

        return view('assessment.create',compact('type','organ'));
    }


    public function store(Request $request)
    {
        $user = $this->getUser();
        if($user->organid == 1) {
            $rules = [
                'title' => 'required|min:6',
                'organid' => 'required',
                'type' => 'required',
            ];
        }
        else{
            $rules = [
                'title' => 'required|min:6',
                'type' => 'required',
            ];
        }
        $this->validate($request, $rules);

        $type = new Assessmenttype();

        $type->organid = ($user->organid == 1) ? $request->organid : $user->organid;
        $type->title = $request->title;
        $type->type = $request->type;
        $type->save();

        return redirect()->back()->withSuccess('Assessment type has been Successfully Created');
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

    public function categoryList(Request $request){
        return view('assessment.categorylist');
    }

    public function categoryCreate(Request $request){
        $kpi = Kpi::all(['id','title']);
        $type = Assessmenttype::all(['id','title']);
        $measure = ['efficiency'=>1, 'effectiveness'=>2];
        return view('assessment.categorycreate',compact('kpi','type','measure'));
    }

    public function categoryStore(Request $request){

        $rules = [
            'measure' => 'required',
            'assessid' => 'required',
            'description' => 'required|min:6|string',
            'kpiid' => 'required',
        ];

        $this->validate($request, $rules);

        if($request->measure === 1){
            $effy = new Deptefficiency();
            $effy->kpiid = $request->kpiid;
            $effy->assessid = $request->assessid;
            $effy->description = $request->description;
            $effy->save();

            return redirect()->back()->withSuccess('Assessment Parameter for Efficency is set');
        }

        $effect = new Deptstate();
        $effect->kpiid = $request->kpiid;
        $effect->assessid = $request->assessid;
        $effect->description = $request->description;
        $effect->save();

        return redirect()->back()->withSuccess('Assessment Parameter for Deptstate is set');
    }

    public function getUser(){
        return Auth::user();
    }

}
