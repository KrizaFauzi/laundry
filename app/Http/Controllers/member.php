<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_member;

class member extends Controller
{
    public function index(Request $request)
    {
        $tb_member = tb_member::all();
        $data = array(
            'tb_member' => $tb_member
        );
        return view('member.index', $data)->with('no', 0);
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tlp' => 'required|string'
        ]);

        tb_member::create($validate);

        if($request->user()->role == "admin"){
            return redirect()->route('member.index');
        }else{
            return redirect()->route('pelanggan.index');
        }
    }


    public function edit($id)
    {
        $tb_member = tb_member::findOrFail($id);
        $data = array(
            'member' => $tb_member,
        );
        return view('member.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $tb_member = tb_member::findOrFail($id);
        $validate = $this->validate($request, [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tlp' => 'required|string'
        ]);

        $tb_member->update($validate);

        if($request->user()->role == "admin"){
            return redirect()->route('member.index');
        }else{
            return redirect()->route('pelanggan.index');
        }
    }

    public function destroy(Request $request, $id)
    {
        $tb_member = tb_member::findOrFail($id);
        $tb_member->delete();

        if($request->user()->role == "admin"){
            return redirect()->route('member.index');
        }else{
            return redirect()->route('pelanggan.index');
        }
        
    }
}
