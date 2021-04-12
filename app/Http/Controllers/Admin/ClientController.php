<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Department;
use App\Models\Licence;
use App\Models\Sector;
use App\Models\State;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['admin','backinvalidate']);
    }

    public function index()
    {
        $sector = Sector::all(['id','name']);
        $client = Client::find(1);
        $state = State::all(['id','name']);
        return view('admin.client.index_detail',compact('sector','client','state'));
    }


    public function create(Request $request)
    {
        $sector = Sector::all(['id','name']);
        $state = State::all(['id','name']);
        $duration = [1,2,3];


        if ($request->ajax()){
            $licence = Licence::where(['duration'=>$request->data, 'used'=>false,'status'=>true])->get(['id','code']);
            return response()->json($licence);
        }

        return view('admin.client.index_create',compact('sector','state','duration'));
    }

    public function store(Request $request)
    {

        $rules = [
            'sectorid' => 'required',
            'name' => 'required',
            'org' => 'required|numeric',
            'duration' => 'required|numeric',
            'licenceid' => 'required',
            'stateid' => 'required',
            'address' => 'required|min:6',
        ];

        $this->validate($request, $rules);

        $car = new Carbon();

        $licence = Licence::find($request->licenceid);

        if($licence){

            $licence->used = true;
            $licence->save();

            $client = new Client();
            $client->stateid = $request->stateid;
            $client->sectorid = $request->sectorid;
            $client->licenceid = $request->licenceid;
            $client->name = $request->name;
            $client->organ = $request->org;
            $client->address = $request->address;
            $client->expiry_date = $car->addYear($request->duration);

            $client->save();

            return redirect()->back()->withSuccess('Client Successfully Created');

        }

        return redirect()->back()->withErrors('Licence Does not Exist');


    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {

        $rules = [
            'sectorid' => 'required',
            'name' => 'required',
            'organ' => 'required|numeric',
            'stateid' => 'required',
            'address' => 'required|min:6',
        ];

        $this->validate($request, $rules);

        $client = Client::find($request->id);
        if ($client){
            $client->stateid = $request->stateid;
            $client->sectorid = $request->sectorid;
            $client->name = $request->name;
            $client->organ = $request->organ;
            $client->address = $request->address;

            $client->save();

            return redirect()->back()->withSuccess('Client record updated');
        }
        return redirect()->back()->withError('Client record not updated');

    }

    public function destroy($id)
    {
        //
    }

    public function renewClient(Request $request){
        $duration = [1,2,3];

        if ($request->ajax()){
            $licence = Licence::where(['duration'=>$request->data, 'used'=>false])->get(['id','code']);
            return response()->json($licence);
        }

        return view('admin.client.renew', compact('duration'));
    }

    public function renewClientPost(Request $request){

        $rules = [
            'duration' => 'required',
            'licenceid' => 'required',
        ];

        $this->validate($request, $rules);

        $licence = Licence::find($request->licenceid);

        if($licence){
            $client = Client::find(1);
            $carbon = Carbon::create($client->expiry_date);

            $client->expiry_date = $carbon->addYear($licence->duration);
            $client->save();

            $licence->used = true;
            $licence->save();

            return redirect()->back()->withSuccess('Client has Successfully been Renew');
        }
        return redirect()->back()->withErrors('Sorry! Client renewal was rejected');
    }


}
