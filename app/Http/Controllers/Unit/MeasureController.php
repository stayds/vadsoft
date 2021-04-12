<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Assessmenttype;
use App\Models\Kpi;
use App\Models\Measuretype;
use App\Models\Unit;
use App\Models\Unitmeasure;
use App\Models\Unitstate;
use App\Models\Unitstatehistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Unitmeasure as Mailmeasure;
use App\Mail\Supervisor;
use App\Mail\Rejection;

class MeasureController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }
    public function index()
    {
        $user = $this->getUser();
        $kpi = Kpi::where('organid',$user->organid)->get(['id','title']);
        $type = Assessmenttype::where(['type'=>'unit','organid'=>$user->organid])->get(['id','title']);
        $unit = Unit::where(['status'=>true,'organid'=>$user->organid])->get(['id','name']);
        $user = User::selectRaw('users.id,userprofiles.fname,userprofiles.lname')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->where(['users.isdev'=> false,'organid'=>$user->organid])
            ->get();

        $measure = Measuretype::all(['id','name']);
        $state = Unitstate::selectRaw('unitstates.id,units.name,unitstates.question_effv,unitstates.question_effy,unitstates.expected_effv,unitstates.expected_effy,unitstates.created_at')
            ->leftJoin('unitmeasures','unitstates.measureid','=','unitmeasures.id')
            ->leftJoin('units','unitmeasures.unitid','=','units.id')
            ->paginate(8);

        return view('measure.unit', compact('kpi','type','measure','user','unit','state'));

    }

    public function store(Request $request)
    {
        if($request->measureid){
            $rules = [
                'measureid' => 'required',
                'measuretypeid' => 'required',
                'question' => 'required',
                'expected_hour' => 'required|numeric',
                'expectedeff' => 'required|numeric',
                'labour' => 'required|numeric',
                'total_num' => 'required|numeric'
            ];

            $this->validate($request, $rules);

            $unitmeasure = Unitmeasure::find($request->measureid);
            $unitstate = Unitstate::where('measureid',$unitmeasure->id)->first();
            $unit = Unit::find($unitmeasure->unitid);
            $user = User::find($unitmeasure->userid);

            /*check if efficiency record has being enter if true then update effectiveness record
              this is done when one record has been entered
            */
            if($unitstate->expected_effy){
                $measure = 'Effectiveness';
                $unitstate->question_effv = $request->question;
                $unitstate->expected_hour_effv = $request->expected_hour;
                $unitstate->expected_effv = $request->expectedeff;
                $unitstate->total_num_effv = $request->total_num;
                $unitstate->labour_effv = $request->labour;
                $unitstate->save();
            }
            else{
                //check if effectiveness has been entered if true update Efficiency record
                $measure = 'Efficency';
                $unitstate->question_effy = $request->question;
                $unitstate->expected_hour_effy = $request->expected_hour;
                $unitstate->expected_effy = $request->expectedeff;
                $unitstate->total_num_effv = $request->total_num;
                $unitstate->labour_effv = $request->labour;
                $unitstate->save();
            }

            \Mail::to($user)->send(new Mailmeasure($measure,$user,$unit));

            $message = $measure.' record has been created';
            //this returns to the form and pass the department measure id
            return redirect()->back()->with(['success'=> $message,'data'=>$unitstate->measureid]);
        }
        else{
            /**
             * this is applied for refresh records that are created
             **/
            $rules = [
                'kpiid' => 'required',
                'unitid' => 'required',
                'assessid' => 'required',
                'measuretypeid' => 'required',
                'userid' => 'required',
                'question' => 'required',
                'expected_hour' => 'required|numeric',
                'expectedeff' => 'required|numeric',
                'total_num' => 'required|numeric',
                'labour' => 'required|numeric'
            ];

            $this->validate($request, $rules);

            $kpi = Kpi::find($request->kpiid);
            $user = User::find($request->userid);
            $unit = Unit::find($request->unitid);

            $unitmeasure = new Unitmeasure();
            $unitmeasure->unitid = $request->unitid;
            $unitmeasure->organid = $user->organid;
            $unitmeasure->userid = $request->userid;
            $unitmeasure->kpiid = $request->kpiid;
            $unitmeasure->assessid = $request->assessid;
            $unitmeasure->routine = $kpi->routine;
            $unitmeasure->save();

            $unitstate = new Unitstate();
            $unitstate->measureid = $unitmeasure->id;

            if($request->measuretypeid == 1){
                $measure = 'Efficency';
                $unitstate->question_effy = $request->question;
                $unitstate->expected_hour_effy = $request->expected_hour;
                $unitstate->expected_effy = $request->expectedeff;
                $unitstate->total_num_effy = $request->total_num;
                $unitstate->labour_effy = $request->labour;
            }
            else{
                $measure = 'Effectiveness';
                $unitstate->question_effv = $request->question;
                $unitstate->expected_hour_effv = $request->expected_hour;
                $unitstate->expected_effv = $requeststatetedeff;
                $unitstate->total_num_effv = $request->total_num;
                $unitstate->labour_effv = $request->labour;
            }

            $unitstate->save();

            \Mail::to($user)->send(new Mailmeasure($measure,$user,$unit));

            $message = $measure.' record has been created, please enter '.(($measure==="Efficency")?"Effectiveness":"Efficiency")." parameter";

            return redirect()->back()->with(['success'=> $message,'data'=>$unitstate->measureid]);
        }

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
        $state = Unitstate::find($id);
        $state->unitstatehistories()->delete();
        $state->delete();
        return redirect()->back()->withSuccess('Record successfully deleted');
    }

    public function unitMeasureEntry(Request $request){

        if ($request->type == 1){
            $type = 1;
            $data = Unitstate::where('id',$request->id)->first(['id','question_effy']);
        }
        else{
            $type = 2;
            $data = Unitstate::where('id',$request->id)->first(['id','question_effv']);
        }
        return view('measure.unitmeasureentry',compact('data','type'));
    }

    public function unitMeasureEntryPost(Request $request){
        $rules = [
            'unitstateid' => 'required',
            'type' => 'required',
            'labour' => 'required',
            'daily_hours' => 'required|numeric',
            'total_num' => 'required|numeric',
            'achievedeff' => 'required|numeric'
        ];

        $this->validate($request, $rules);
        $state = Unitstate::find($request->unitstateid);
        $measure = Unitmeasure::find($state->measureid);
        $unit = Unit::find($measure->unitid);
        $history = Unitstatehistory::where('unitstateid', $request->unitstateid)->latest()->first();
        $data = $unit->users()->withPivot('supervisor')->where('unit_user.supervisor',1)->first();
        $user = User::find($data->pivot->user_id);

        if($history != null){
            if ($request->type == 1){
                $measures = "Efficiency";
                $history->unitstateid = $request->unitstateid;
                $history->daily_hours_effy = $request->daily_hours;
                $history->labour_effy = $request->labour;
                $history->total_num_effy = $request->total_num;
                $history->achievedeff_effy = $request->achievedeff;
                $history->approve_effy = 0;
                $history->save();
            }
            else {

                $measures = "Effectiveness";
                $history->daily_hours_effv = $request->daily_hours;
                $history->labour_effv = $request->labour;
                $history->total_num_effv = $request->total_num;
                $history->achievedeff_effv = $request->achievedeff;
                $history->approve_effv = 0;

                $history->save();

            }
        }
        else{
            if ($request->type == 1){
                $record = new Unitstatehistory();
                $measures = "Efficiency";
                $record->unitstateid = $request->unitstateid;
                $record->supervisorid = $user->id;
                $record->daily_hours_effy = $request->daily_hours;
                $record->labour_effy = $request->labour;
                $record->total_num_effy = $request->total_num;
                $record->achievedeff_effy = $request->achievedeff;
                $record->approve_effy = 0;
                $record->save();
            }
            else {
                $record = new Unitstatehistory();
                $measures = "Effectiveness";
                $record->unitstateid = $request->unitstateid;
                $record->supervisorid = $user->id;
                $record->daily_hours_effv = $request->daily_hours;
                $record->labour_effv = $request->labour;
                $record->total_num_effv = $request->total_num;
                $record->achievedeff_effv = $request->achievedeff;
                $record->approve_effv = 0;
                $record->save();

            }
        }

        \Mail::to($user)->send(new Supervisor($user, $measures));

        return redirect()->route('home');
    }

    public function dataView($measureid,$historyid){
        $data = Unitstate::with(['unitstatehistories'=>function($query) use ($historyid){
            $query->select('*')->where('id',$historyid);
        }])
            ->where(['measureid'=>$measureid])
            ->first();

        return view('measure.unitsupervisor',compact('data'));
    }

    public function dataApproved($measureid,$approve,$unitstateid,$historyid){

        // if approve is 2 then the data has been approved while 1 means rejected
        if($approve == 2){

            $measure = Unitmeasure::find($measureid);
            $next_time = $this->getRoutine($measure);
            $measure->next_entry = $next_time;
            $measure->save();

            $state = Unitstate::find($unitstateid);
            $history = Unitstatehistory::find($historyid);

            $history->kpi = $this->calculateEff($state, $history);
            $history->approve_effy = 2;
            $history->approve_effv = 2;
            $history->save();

//            $parameters = ['measureid'=>$measureid,'historyid'=>$historyid];
//            return redirect()->route('get.measure.unit.supervisor',$parameters);
            return response()->json(['success'=>true]);
        }
        elseif ($approve == 1){

            $measure = Unitmeasure::find($measureid);
            $history = Unitstatehistory::find($historyid);
            $user = User::find($measure->userid);
            $unit = Unit::find($measure->unitid);

            $measure = "Data entered for ".$unit->name." Departments measurement parameter has been rejected. Please login and update your entry";

            $history->approve_effy = 1;
            $history->approve_effv = 1;
            $history->save();

           // $parameters = ['measureid'=>$measureid,'historyid'=>$historyid];

            \Mail::to($user)->send(new Rejection($measure,$user));

            //return redirect()->route('get.measure.department.supervisor',$parameters);
            return response()->json(['success'=>true]);
        }

    }

    private function getRoutine($data){

        if($data->routine=='daily'){
            $created = $data->created_at;
            return $created->addDay(1);
        }
        elseif ($data->routine=='weekly'){
            $created = $data->created_at;
            return $created->addWeek(1);
        }
        elseif($data->routine=='monthly'){
            $created = $data->created_at;
            return $created->addMonth(1);

        }
        elseif($data->routine=='quarterly'){
            $created = $data->created_at;
            return $created->addQuarter(1);
        }
        else{
            $created = $data->created_at;
            return $created->addYears(1);
        }
    }

    private function calculateEff($state, $history){

        $effy_input = $state->expected_effy/($state->labour_effy * $state->expected_hour_effy * $state->total_num_effy);
        $effy_output = $history->achievedeff_effy/($history->labour_effy * $history->daily_hours_effy * $history->total_num_effy);
        $efficient_check = $effy_output/$effy_input;

        $effv_input = $state->expected_effv/($state->labour_effv * $state->expected_hour_effv * $state->total_num_effv);
        $effv_output = $history->achievedeff_effv/($history->labour_effv * $history->daily_hours_effv * $history->total_num_effv);

        $effective_check = $effv_output/$effv_input;

        $productidex = $efficient_check * $effective_check;

        return $productidex;
    }

    private function getUser(){
        return Auth::user();
    }
}
