<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin','backinvalidate']);
    }

    public function index()
    {
        $organ = Organisation::where('status',true)->get(['id'])->count();
        $user = User::where('isdev',false)->get(['id'])->count();
        $client = (Client::find(1));
        return view('admin.home.index',compact('organ','user','client'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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

    public function changePassword(){
        return view('admin.home.changepassword');
    }

    public function changePasswordPost(Request $request){
        $rules = [
            'password' => 'required|confirmed|min:6'
        ];

        $this->validate($request, $rules);

        $user = $this->getUser();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->withSuccess('User Password has been Changed');
    }

    private function getUser(){
        return Auth::guard('adminweb')->user();
    }

}
