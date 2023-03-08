<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tb_outlet;
use App\Models\tb_paket;

class paket extends Controller
{
    public function index()
    {
        $paket = tb_paket::all();
        $data = array(
            'tb_paket' => $paket
        );
        return view('paket.index', $data)->with('no', 0);
    }

    public function create()
    {  
        $outlet = tb_outlet::all();
        $data = array(
            'outlet' => $outlet
        );
        return view('paket.create', $data);
    }

    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'id_outlet' => 'required|string',
            'jenis' => 'required|string',
            'nama_paket' => 'required|string',
            'harga' => 'required|numeric'
        ]);

        tb_paket::create($validate);
        return redirect()->route('paket.index');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $paket = tb_paket::findOrFail($id);
        $outlet = tb_outlet::all();
        $data = array(
            'paket' => $paket,
            'outlet' => $outlet
        );
        return view('paket.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $paket = tb_paket::findOrFail($id);
        $validate = $this->validate($request, [
            'id_outlet' => 'required|string',
            'jenis' => 'required|string',
            'nama_paket' => 'required|string',
            'harga' => 'required|numeric'
        ]);

        $paket->update($validate);

        return redirect()->route('paket.index');
    }

    public function destroy($id)
    {
        $paket = tb_paket::findOrFail($id);
        $paket->delete();
        return redirect()->route('paket.index');
    }
}
