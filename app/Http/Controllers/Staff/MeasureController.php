<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Mail\Rejection;
use App\Mail\Staffmeasure as Mailmeasure;
use App\Mail\Supervisor;
use App\Models\Assessmenttype;
use App\Models\Kpi;
use App\Models\Measuretype;
use App\Models\Staffmeasure;
use App\Models\Staffstate;
use App\Models\Staffstatehistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $type = Assessmenttype::where(['type'=>'staff','organid'=>$user->organid])->get(['id','title']);
        $user = User::selectRaw('users.id,userprofiles.fname,userprofiles.lname')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->where(['users.isdev'=> false,'organid'=>$user->organid])
            ->get();

        $measure = Measuretype::all(['id','name']);

        $state = Staffstate::selectRaw('staffstates.id,userprofiles.lname,userprofiles.fname,staffstates.created_at')
            ->leftJoin('staffmeasures','staffstates.measureid','=','staffmeasures.id')
            ->leftJoin('users','staffmeasures.userid','=','users.id')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->paginate(8);

        return view('measure.staff', compact('kpi','type','measure','user','state'));

    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if($request->measureid){
            $rules = [
                'measureid' => 'required',
                'measuretypeid' => 'required',
                'question' => 'required',
                'expected_hour' => 'required|numeric',
//                'labour' => 'required|numeric',
                'total_num' => 'required|numeric',
                'expectedeff' => 'required|numeric'
            ];

            $this->validate($request, $rules);

            $staffmeasure = Staffmeasure::find($request->measureid);
            $staffstate = Staffstate::where('measureid',$staffmeasure->id)->first();
            $user = User::find($staffmeasure->userid);

            /*check if efficiency record has being enter if true then update effectiveness record
              this is done when one record has been entered
            */
            if($staffstate->expected_effy){
                $measure = 'Effectiveness';
                $staffstate->question_effv = $request->question;
                $staffstate->expected_hour_effv = $request->expected_hour;
                $staffstate->expected_effv = $request->expectedeff;
                $staffstate->total_num_effv = $request->total_num;
                $staffstate->labour_effv = 1;
                $staffstate->save();
            }
            else{
                //check if effectiveness has been entered if true update Efficiency record
                $measure = 'Efficiency';
                $staffstate->question_effy = $request->question;
                $staffstate->expected_hour_effy = $request->expected_hour;
                $staffstate->expected_effy = $request->expectedeff;
                $staffstate->total_num_effy = $request->total_num;
                $staffstate->labour_effy = 1;
                $staffstate->save();
            }
            $name = $user->name;
            \Mail::to($user)->send(new Mailmeasure($measure,$name));

            $message = $measure.' record has been created';
            //this returns to the form and pass the department measure id
            return redirect()->back()->with(['success'=> $message,'data'=>$staffstate->measureid]);
        }
        else{
            /**
             * this is applied for refresh records that are created
             **/
            $rules = [
                'kpiid' => 'required',
                'assessid' => 'required',
                'measuretypeid' => 'required',
                'userid' => 'required',
                'question' => 'required',
                'expected_hour' => 'required|numeric',
//                'labour' => 'required|numeric',
                'total_num' => 'required|numeric',
                'expectedeff' => 'required|numeric'
            ];

            $this->validate($request, $rules);

            $kpi = Kpi::find($request->kpiid);
            $user = User::find($request->userid);

            $staffmeasure = new Staffmeasure();
            $staffmeasure->organid = $user->organid;
            $staffmeasure->userid = $request->userid;
            $staffmeasure->kpiid = $request->kpiid;
            $staffmeasure->assessid = $request->assessid;
            $staffmeasure->routine = $kpi->routine;
            $staffmeasure->save();

            $staffstate = new Staffstate();
            $staffstate->measureid = $staffmeasure->id;

            if($request->measuretypeid == 1){
                $measure = 'Efficency';
                $staffstate->question_effy = $request->question;
                $staffstate->expected_hour_effy = $request->expected_hour;
                $staffstate->expected_effy = $request->expectedeff;
                $staffstate->total_num_effy = $request->total_num;
                $staffstate->labour_effy = 1;
            }
            else{
                $measure = 'Effectiveness';
                $staffstate->question_effv = $request->question;
                $staffstate->expected_hour_effv = $request->expected_hour;
                $staffstate->expected_effv = $request->expectedeff;
                $staffstate->total_num_effv = $request->total_num;
                $staffstate->labour_effv = 1;
            }

            $staffstate->save();
            $name = $user->name;
            \Mail::to($user)->send(new Mailmeasure($measure,$name));

            $message = $measure.' record has been created, please enter '.(($measure==="Efficency")?"Effectiveness":"Efficiency")." parameter";

            return redirect()->back()->with(['success'=> $message,'data'=>$staffstate->measureid]);
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
        $state = Staffstate::find($id);
        $state->staffstatehistories()->delete();
        $state->delete();
        return redirect()->back()->withSuccess('Record successfully deleted');
    }

    public function staffMeasureEntry(Request $request){

        if ($request->type == 1){
            $type = 1;
            $data = Staffstate::where('id',$request->id)
                ->first(['id','question_effy','expected_hour_effy','total_num_effy']);

        }
        else{
            $type = 2;
            $data = Staffstate::where('id',$request->id)
                ->first(['id','question_effv','expected_hour_effy','total_num_effy']);
        }
        return view('measure.staffmeasureentry',compact('data','type'));
    }

    public function staffMeasureEntryPost(Request $request){
        $rules = [
            'staffstateid' => 'required',
            'type' => 'required',
            'daily_hours' => 'required|numeric',
            'total_num' => 'required|numeric',
            'achievedeff' => 'required|numeric'
        ];

        $this->validate($request, $rules);
        $state = Staffstate::find($request->staffstateid);
        $measure = Staffmeasure::find($state->measureid);
        $user = User::where(['organid'=>$measure->organid, 'supervisor'=>true])->first();
        $history = Staffstatehistory::where('staffstateid', $request->staffstateid)->latest()->first();

        if($history != null){
            if ($request->type == 1){
                $measures = "Efficiency";
                $history->staffstateid = $request->staffstateid;
                $history->daily_hours_effy = $request->daily_hours;
                $history->labour_effy = 1;
                $history->total_num_effy = $request->total_num;
                $history->achievedeff_effy = $request->achievedeff;
                $history->approve_effy = 0;
                $history->save();
            }
            else {

                $measures = "Effectiveness";
                $history->daily_hours_effv = $request->daily_hours;
                $history->labour_effv = 1;
                $history->total_num_effv = $request->total_num;
                $history->achievedeff_effv = $request->achievedeff;
                $history->approve_effv = 0;

                $history->save();

            }
        }
        else{
            if ($request->type == 1){
                $record = new Staffstatehistory();
                $measures = "Efficiency";
                $record->staffstateid = $request->staffstateid;
                $record->supervisorid = $user->id;
                $record->daily_hours_effy = $request->daily_hours;
                $record->labour_effy = 1;
                $record->total_num_effy = $request->total_num;
                $record->achievedeff_effy = $request->achievedeff;
                $record->approve_effy = 0;
                $record->save();
            }
            else {
                $record = new Staffstatehistory();
                $measures = "Effectiveness";
                $record->staffstateid = $request->staffstateid;
                $record->supervisorid = $user->id;
                $record->daily_hours_effv = $request->daily_hours;
                $record->labour_effv = 1;
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
        $data = Staffstate::with([
                                'staffstatehistories'=>function($query) use ($historyid){
                                        $query->select('*')->where('id',$historyid);
                            }])
                            ->where(['measureid'=>$measureid])
                            ->first();

        return view('measure.staffsupervisor',compact('data'));
    }

    public function dataApproved($measureid,$approve,$staffstateid,$historyid){

        // if approve is 2 then the data has been approved while 1 means rejected
        if($approve == 2){

            $measure = Staffmeasure::find($measureid);
            $next_time = $this->getRoutine($measure);
            $measure->next_entry = $next_time;
            $measure->save();

            $state = Staffstate::find($staffstateid);
            $history = Staffstatehistory::find($historyid);

            $history->kpi = $this->calculateEff($state, $history);
            $history->approve_effy = 2;
            $history->approve_effv = 2;
            $history->save();

            //$parameters = ['measureid'=>$measureid,'historyid'=>$historyid];
            return response()->json(['success'=>true]);
            //return redirect()->route('get.measure.staff.supervisor',$parameters);
        }
        elseif ($approve == 1){

            $measure = Staffmeasure::find($measureid);
            $history = Staffstatehistory::find($historyid);
            $user = User::find($measure->userid);

            $measure = "Data entered for ".$user->userprofile->fullname()." Departments measurement parameter has been rejected. Please login and update your entry";

            $history->approve_effy = 1;
            $history->approve_effv = 1;
            $history->save();

            //$parameters = ['measureid'=>$measureid,'historyid'=>$historyid];

            \Mail::to($user)->send(new Rejection($measure,$user));

            //return redirect()->route('get.measure.staff.supervisor',$parameters);
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
