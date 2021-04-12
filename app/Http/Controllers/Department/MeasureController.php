<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Mail\Rejection;
use App\Mail\Supervisor;
use App\Models\Assessmenttype;
use App\Models\Department;
use App\Models\Deptmeasure;
use App\Models\Deptstate;
use App\Models\Deptstatehistory;
use App\Models\Kpi;
use App\Models\Measuretype;
use App\Models\Staffstate;
use App\Models\Staffstatehistory;
use App\Models\Unitmeasure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Deptmeasure as Mailmeasure;

class MeasureController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }

    public function index()
    {
        $users = $this->getUser();
        $kpi = Kpi::where('organid',$users->organid)->get(['id','title']);
        $type = Assessmenttype::where(['type'=>'department','organid'=>$users->organid])
                                ->get(['id','title']);
        $dept = Department::where(['status'=>true,'organisationid'=>$users->organid])->get(['id','name']);
        $user = User::selectRaw('users.id,userprofiles.fname,userprofiles.lname')
            ->leftJoin('userprofiles','users.id','=','userprofiles.userid')
            ->where(['users.isdev'=> false,'organid'=>$users->organid])
            ->get();

       // $measure = Measuretype::where('name','effectiveness')->get(['id','name']);
        $measure = Measuretype::get(['id','name']);

        $state = Deptstate::selectRaw('deptstates.id,departments.name,deptstatehistories.approve_effy,deptstates.measureid,deptmeasures.status,deptstates.question_effv,deptstates.question_effy,deptstates.expected_effv,deptstates.expected_effy,deptstates.created_at')
                 ->leftJoin('deptmeasures','deptstates.measureid','=','deptmeasures.id')
                 ->leftJoin('departments','deptmeasures.deptid','=','departments.id')
                 ->leftJoin('deptstatehistories','deptstatehistories.deptstateid','=','deptstates.id')
                 ->where('deptmeasures.organid',$users->organid)
                 ->paginate(8);

        return view('measure.department', compact('kpi','type','measure','user','dept','state'));

    }

    public function store(Request $request)
    {
        if($request->measureid){
            $rules = [
                'measureid' => 'required',
                'measuretypeid' => 'required',
                'question' => 'required',
//                'expected_hour' => 'required',
//                'expectedeff' => 'required',
//                'labour'=>'required',
//                'total_num'=>'required'
            ];

            $this->validate($request, $rules);

            $deptmeasure = Deptmeasure::find($request->measureid);
            $deptstate = Deptstate::where('measureid',$deptmeasure->id)->first();
            $dept = Department::find($deptmeasure->deptid);
            $user = User::find($deptmeasure->userid);

            /*check if efficiency record has being enter if true then update effectiveness record
              this is done when one record has been entered
            */

            if($deptstate->expected_effy){
                $measure = 'Effectiveness';
                $deptstate->question_effv = $request->question;
//                $deptstate->expected_hour_effv = $request->expected_hour;
//                $deptstate->expected_effv = $request->expectedeff;
//                $deptstate->total_num_effv = $request->total_num;
//                $deptstate->labour_effv = $request->labour;
                $deptstate->save();
            }
            else{
                //check if effectiveness has been entered if true update Efficiency record
                $measure = 'Efficency';
                $deptstate->question_effy = $request->question;
//                $deptstate->expected_hour_effy = $request->expected_hour;
//                $deptstate->expected_effy = $request->expectedeff;
//                $deptstate->total_num_effy = $request->total_num;
//                $deptstate->labour_effy = $request->labour;
                $deptstate->save();
            }

            \Mail::to($user)->send(new Mailmeasure($measure,$user,$dept));

            $message = $measure.' record has been created';
            //this returns to the form and pass the department measure id
            return redirect()->back()->with(['success'=> $message,'data'=>$deptstate->measureid]);
        }
        else{
            /**
             * this is applied for refresh records that are created
             **/
            $rules = [
                'kpiid' => 'required',
                'deptid' => 'required',
                'assessid' => 'required',
                'measuretypeid' => 'required',
                'userid' => 'required',
                'question' => 'required',
//                'expected_hour' => 'required',
//                'expectedeff' => 'required',
//                'total_num' => 'required',
//                'labour' => 'required'
            ];

            $this->validate($request, $rules);

            $kpi = Kpi::find($request->kpiid);
            $user = User::find($request->userid);
            $dept = Department::find($request->deptid);

            $deptmeasure = new Deptmeasure();
            $deptmeasure->deptid = $request->deptid;
            $deptmeasure->organid = $user->organid;
            $deptmeasure->userid = $request->userid;
            $deptmeasure->kpiid = $request->kpiid;
            $deptmeasure->assessid = $request->assessid;
            $deptmeasure->routine = $kpi->routine;
            $deptmeasure->save();

            $deptstate = new Deptstate();
            $deptstate->measureid = $deptmeasure->id;

            if($request->measuretypeid == 1){
                $measure = 'Efficency';
                $deptstate->question_effy = $request->question;
//                $deptstate->expected_hour_effy = $request->expected_hour;
//                $deptstate->expected_effy = $request->expectedeff;
//                $deptstate->total_num_effy = $request->total_num;
//                $deptstate->labour_effy = $request->labour;
            }
            else{
                $measure = 'Effectiveness';
                $deptstate->question_effv = $request->question;
//                $deptstate->expected_hour_effv = $request->expected_hour;
//                $deptstate->expected_effv = $request->expectedeff;
//                $deptstate->total_num_effv = $request->total_num;
//                $deptstate->labour_effv = $request->labour;
            }

            $deptstate->save();

            \Mail::to($user)->send(new Mailmeasure($measure,$user,$dept));

            $message = $measure.' record has been created, please enter '.(($measure==="Efficency")?"Effectiveness":"Efficiency")." parameter";

            return redirect()->back()->with(['success'=> $message,'data'=>$deptstate->measureid]);
        }

        //return redirect()->back()->with(['success'=> $message]);

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
        $state = Deptstate::find($id);
        if ($state){
            $state->status = ($state->status == 1 ? 0 : 1);
            $state->save();
            return redirect()->back()->withSuccess('Measure status have been updated');
        }

        return redirect()->back()->withSuccess('Measure status not updated');
    }

    public function deptMeasureEntry(Request $request){

        if ($request->type == 1){
            $type = 1;
            $data = Deptstate::where('id',$request->id)
                ->first(['id','question_effy']);
        }
        else{
            $type = 2;
            $data = Deptstate::where('id',$request->id)
                    ->first(['id','question_effv']);
        }

        return view('measure.deptmeasureentry',compact('data','type'));
    }

    public function deptMeasureEntryPost(Request $request){

        $rules = [
            'deptstateid' => 'required',
            'type' => 'required',
            'labour' => 'required',
            'daily_hours' => 'required',
            'total_num' => 'required',
            'achievedeff' => 'required',
            'expectedeff' => 'required'
        ];

        $this->validate($request, $rules);
        $state = Deptstate::find($request->deptstateid);
        $measure = Deptmeasure::find($state->measureid);
        $department = Department::find($measure->deptid);
        $history = Deptstatehistory::where('deptstateid', $request->deptstateid)->latest()->first();
        $data = $department->users()
                    ->withPivot('supervisor')
                    ->where('department_user.supervisor',1)
                    ->first();

        $user = User::find($data->pivot->user_id);

        if($history != null){
            if ($request->type == 1){

                $state->expected_hour_effy = $request->daily_hours;
                $state->expected_effy = $request->expectedeff;
                $state->total_num_effy = $request->total_num;
                $state->labour_effy = $request->labour;
                $state->save();

                $measures = "Efficiency";
                $history->deptstateid = $request->deptstateid;
                $history->daily_hours_effy = $request->daily_hours;
                $history->labour_effy = $request->labour;
                $history->total_num_effy = $request->total_num;
                $history->achievedeff_effy = $request->achievedeff;
                $history->approve_effy = 0;
                $history->save();
            }
            else {

                $state->expected_hour_effv = $request->daily_hours;
                $state->expected_effv = $request->expectedeff;
                $state->total_num_effv = $request->total_num;
                $state->labour_effv = $request->labour;
                $state->save();

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

                $state->expected_hour_effy = $request->daily_hours;
                $state->expected_effy = $request->expectedeff;
                $state->total_num_effy = $request->total_num;
                $state->labour_effy = $request->labour;
                $state->save();


                $record = new Deptstatehistory();
                $measures = "Efficiency";
                $record->deptstateid = $request->deptstateid;
                $record->supervisorid = $user->id;
                $record->daily_hours_effy = $request->daily_hours;
                $record->labour_effy = $request->labour;
                $record->total_num_effy = $request->total_num;
                $record->achievedeff_effy = $request->achievedeff;
                $record->approve_effy = 0;
                $record->save();
            }
            else {

                $state->expected_hour_effv = $request->daily_hours;
                $state->expected_effv = $request->expectedeff;
                $state->total_num_effv = $request->total_num;
                $state->labour_effv = $request->labour;
                $state->save();

                $record = new Deptstatehistory();
                $measures = "Effectiveness";
                $record->deptstateid = $request->deptstateid;
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
        $data = Deptstate::with(['deptstatehistories'=>function($query) use ($historyid){
                                $query->select('*')->where('id',$historyid);
                            }])
                            ->where(['measureid'=>$measureid])
                            ->first();

        return view('measure.deptsupervisor',compact('data'));
    }

    public function dataApproved($measureid,$approve,$deptstateid,$historyid){

        // if approve is 2 then the data has been approved while 1 means rejected
        if($approve == 2){

            $measure = Deptmeasure::find($measureid);
            $next_time = $this->getRoutine($measure);
            $measure->next_entry = $next_time;
            $measure->save();

            $state = Deptstate::find($deptstateid);
            $history = Deptstatehistory::find($historyid);

            $history->kpi = $this->calculateEff($state, $history);
            $history->approve_effy = 2;
            $history->approve_effv = 2;
            $history->save();

//            $parameters = ['measureid'=>$measureid,'historyid'=>$historyid];
//            return redirect()->route('get.measure.department.supervisor',$parameters);
            return response()->json(['success'=>true]);
        }
        elseif ($approve == 1){

            $measure = Deptmeasure::find($measureid);
            $history = Deptstatehistory::find($historyid);
            $user = User::find($measure->userid);
            $dept = Department::find($measure->deptid);

            $measure = "Data entered for ".$dept->name." Departments measurement parameter has been rejected. Please login and update your entry";

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
        $eff_in_state = $state->labour_effy * $state->expected_hour_effy * $state->total_num_effy;
        $effy_input = $state->expected_effy/$eff_in_state;

        $eff_out_state = $history->labour_effy * $history->daily_hours_effy * $history->total_num_effy;
        $effy_output = $history->achievedeff_effy/$eff_out_state;
        $efficient_check = $effy_output/$effy_input;

        $effv_in = $state->labour_effv * $state->expected_hour_effv * $state->total_num_effv;
        $effv_input = $state->expected_effv/$effv_in;
        $effv_out = $history->labour_effv * $history->daily_hours_effv * $history->total_num_effv;
        $effv_output = $history->achievedeff_effv/$effv_out;
        $effective_check = $effv_output/$effv_input;

        $productidex = $efficient_check * $effective_check;

        return $productidex;

    }

    private function getUser(){
        return Auth::user();
    }
}
