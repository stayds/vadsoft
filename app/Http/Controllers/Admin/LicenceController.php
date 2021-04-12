<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Licence;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LicenceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin','backinvalidate']);
    }

    public function index()
    {
        $licence = Licence::paginate(10);
        return view('admin.client.licence_list',compact('licence'));
    }

    public function create()
    {
        $duration = [1,2,3];
        return view('admin.client.licence_create', compact('duration'));
    }


    public function store(Request $request)
    {
        $rules = [
            'duration' => 'required',
            'num_licence' => 'required|numeric',
        ];

        $this->validate($request, $rules);
        $faker = Faker::create();
        $data = [];
        for($i = 0; $i <= $request->duration; ++$i){
            $code = $faker->randomLetter.'-'.mt_rand(123456789,9999999999);
            $data[] = [
                'code' => $code,
                'duration' => $request->duration
            ] ;

        }

        DB::table('licences')->insert($data);
        return redirect()->back()->withSuccess('Licence Successfully Created');
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
        $licence = Licence::find($id);
        if ($licence){
            $licence->status = ($licence->status == 1 ? 0 : 1);
            $licence->save();
            return redirect()->back()->withSuccess('Licence Status Updated');
        }
        return redirect()->back()->withSuccess('Licence status not updated');

    }
}
