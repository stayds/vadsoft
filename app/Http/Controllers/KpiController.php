<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KpiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','backinvalidate','verified']);
    }

    public function index()
    {
        $user = $this->getUser();
        if($user->organid == 1){
            $kpi = Kpi::paginate(10);

        }else{
            $kpi = Kpi::where('organid',$user->organid)->paginate(10);
        }

        return view('assessment.kpi',compact('kpi'));
    }

    public function create()
    {
        $routine = ['daily','weekly','monthly','quarterly','annually'];
        $user = $this->getUser();

        if($user->organid == 1){
            $organ = Organisation::where('status',true)->get(['id','name']);
        }
        else{
            $organ = "";
        }

        return view('assessment.kpicreate', compact('routine','organ'));
    }


    public function store(Request $request)
    {
        $user = $this->getUser();
        if($user->organid == 1) {
            $rules = [
                'title' => 'required|min:6',
                'organid' => 'required',
                'routine' => 'required',
            ];
        }
        else{
            $rules = [
                'title' => 'required|min:6',
                'routine' => 'required',
            ];
        }

        $this->validate($request, $rules);

        $kpi = new Kpi();

        $kpi->organid = ($user->organid == 1) ? $request->organid : $user->organid;
        $kpi->title = $request->title;
        $kpi->routine = $request->routine;
        $kpi->save();

        return redirect()->back()->withSuccess('KPI has been Created');
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getUser(){
        return Auth::user();
    }
}
