<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\tb_outlet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class admin extends Controller
{

    public function index()
    {
        $user = User::all();
        $data = array(
            'user'  => $user,
        );
        return view('user.index', $data)->with('no', 0);
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
        $user = User::findOrFail($id);
        $outlet = tb_outlet::all();
        $data = array(
            'outlet' => $outlet,
            'user' => $user
        );
        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',
            'role' => 'required|string'
        ]);
        if ( $request->outlet == "kosong" ){
            $request->outlet = null;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'id_outlet' => $request->outlet
        ]);
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }
}
