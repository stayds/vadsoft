<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    public function staffMeasure(){

        $kpi = Kpi::all(['id','title']);
        $type = Assessmenttype::where('type','staff')->get(['id','title']);

        $user = User::selectRaw('users.id,userprofiles.fname,userprofiles.lname')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->where('users.isdev', false)
            ->get();

        $measure = ['efficiency'=>1, 'effectiveness'=>2];

        return view('measure.staff', compact('kpi','type','measure','user'));
    }

    public function staffMeasurePost(Request $request){

        $rules = [
            'measure' => 'required',
            'description' => 'required|min:6|string',
            'kpiid' => 'required',
            'assessid' => 'required',
            'userid' => 'required',
            'question' => 'required',
            'expectedeff' => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $kpi = Kpi::find($request->kpiid);

        if($request->measure == 1){

            $staffeffy = new Staffefficient();
            $staffeffy->routine = $kpi->routine;
            $staffeffy->description = $request->description;
            $staffeffy->kpiid = $request->kpiid;
            $staffeffy->assessid = $request->assessid;
            $staffeffy->userid = $request->userid;
            $staffeffy->question = $request->question;
            $staffeffy->expectedeff = $request->expectedeff;

            $staffeffy->save();
            return redirect()->back()->withSuccess('Record Successfully Created');

        }

        $staffefft = new Staffeffective();
        $staffefft->routine = $kpi->routine;
        $staffefft->description = $request->description;
        $staffefft->kpiid = $request->kpiid;
        $staffefft->assessid = $request->assessid;
        $staffefft->userid = $request->userid;
        $staffefft->question = $request->question;
        $staffefft->expectedeff = $request->expectedeff;

        $staffefft->save();

        return redirect()->back()->withSuccess('Record Successfully Created');

    }

    public function deptMeasure(){

        $kpi = Kpi::all(['id','title']);
        $type = Assessmenttype::where('type','department')->get(['id','title']);
        $dept = Department::where('status',true)->get(['id','name']);
        $user = User::selectRaw('users.id,userprofiles.fname,userprofiles.lname')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->where('users.isdev', false)
            ->get();

        $measure = ['efficiency'=>1, 'effectiveness'=>2];

        return view('measure.department', compact('kpi','type','measure','user','dept'));
    }

    public function deptMeasurePost(Request $request){

        $rules = [
            'measure' => 'required',
            'description' => 'required|min:6|string',
            'kpiid' => 'required',
            'deptid' => 'required',
            'assessid' => 'required',
            'userid' => 'required',
            'question' => 'required',
            'expectedeff' => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $kpi = Kpi::find($request->kpiid);

        if($request->measure == 1){

            $depteffy = new Deptefficiency();
            $depteffy->routine = $kpi->routine;
            $depteffy->description = $request->description;
            $depteffy->kpiid = $request->kpiid;
            $depteffy->deptid = $request->deptid;
            $depteffy->assessid = $request->assessid;
            $depteffy->userid = $request->userid;
            $depteffy->question = $request->question;
            $depteffy->expectedeff = $request->expectedeff;

            $depteffy->save();
            return redirect()->back()->withSuccess('Record Successfully Created');

        }

        $depteffy = new Depteffectiveness();
        $depteffy->routine = $kpi->routine;
        $depteffy->description = $request->description;
        $depteffy->kpiid = $request->kpiid;
        $depteffy->deptid = $request->deptid;
        $depteffy->assessid = $request->assessid;
        $depteffy->userid = $request->userid;
        $depteffy->question = $request->question;
        $depteffy->expectedeff = $request->expectedeff;

        $depteffy->save();

        return redirect()->back()->withSuccess('Record Successfully Created');

    }

    public function unitMeasure(){

        $kpi = Kpi::all(['id','title']);
        $type = Assessmenttype::where('type','unit')->get(['id','title']);
        $unit = Unit::where('status',true)->get(['id','name']);
        $user = User::selectRaw('users.id,userprofiles.fname,userprofiles.lname')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->where('users.isdev', false)
            ->get();

        $measure = ['efficiency'=>1, 'effectiveness'=>2];

        return view('measure.unit', compact('kpi','type','measure','user','unit'));
    }

    public function unitMeasurePost(Request $request){

        $rules = [
            'measure' => 'required',
            'description' => 'required|min:6|string',
            'kpiid' => 'required',
            'unitid' => 'required',
            'assessid' => 'required',
            'userid' => 'required',
            'question' => 'required',
            'expectedeff' => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $kpi = Kpi::find($request->kpiid);

        if($request->measure == 1){

            $uniteffy = new Unitefficient();
            $uniteffy->routine = $kpi->routine;
            $uniteffy->description = $request->description;
            $uniteffy->kpiid = $request->kpiid;
            $uniteffy->unitid = $request->unitid;
            $uniteffy->assessid = $request->assessid;
            $uniteffy->userid = $request->userid;
            $uniteffy->question = $request->question;
            $uniteffy->expectedeff = $request->expectedeff;

            $uniteffy->save();
            return redirect()->back()->withSuccess('Record Successfully Created');

        }

        $uniteffy = new Uniteffective();
        $uniteffy->routine = $kpi->routine;
        $uniteffy->description = $request->description;
        $uniteffy->kpiid = $request->kpiid;
        $uniteffy->deptid = $request->deptid;
        $uniteffy->assessid = $request->assessid;
        $uniteffy->userid = $request->userid;
        $uniteffy->question = $request->question;
        $uniteffy->expectedeff = $request->expectedeff;

        $uniteffy->save();

        return redirect()->back()->withSuccess('Record Successfully Created');

    }
}
