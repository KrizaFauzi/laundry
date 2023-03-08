<?php

namespace App\Http\Controllers;

use App\Models\tb_outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class outlet extends Controller
{

    public function index(Request $request)
    {
        $tb_outlet = tb_outlet::all();
        $data = array(
            'tb_outlet' => $tb_outlet
        );
        return view('outlet.index', $data)->with('no', 0);
    }

    public function create()
    {
        return view('outlet.create');
    }

    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tlp' => 'required|string'
        ]);

        tb_outlet::create($validate);

        return redirect()->route('outlet.index');
    }


    public function edit($id)
    {
        $tb_outlet = tb_outlet::findOrFail($id);
        $data = array(
            'outlet' => $tb_outlet,
        );
        return view('outlet.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $tb_outlet = tb_outlet::findOrFail($id);
        $validate = $this->validate($request, [
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tlp' => 'required|string'
        ]);

        $tb_outlet->update($validate);

        return redirect()->route('outlet.index');
    }

    public function destroy($id)
    {
        $tb_outlet = tb_outlet::findOrFail($id);
        $tb_outlet->delete();
        return redirect()->route('outlet.index');
    }
}
