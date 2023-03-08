<?php

namespace App\Http\Controllers;

use App\Models\tb_paket;
use App\Models\tb_member;
use App\Models\tb_outlet;
use App\Models\tb_transaksi;
use App\Models\tb_detail_transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class transaksi extends Controller
{
    public function index()
    {
        $transaksi = tb_transaksi::all();
        $data = array(
            'transaksi' => $transaksi
        );
        return view('transaksi.index', $data)->with('no', 0);
    }

    public function create()
    {
        $outlet = tb_outlet::all();
        $member = tb_member::all();
        $paket = tb_paket::all();
        $data = array(
            'outlet' => $outlet,
            'member' => $member,
            'paket' => $paket
        );
        return view('transaksi.create', $data);
    }

    public function store(Request $request)
    {       
        $this->validate($request, [
            'id_member' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
            'diskon' => 'required',
            'pajak' => 'required',
            'biaya_tambahan' => 'required',
            'tanggal' => 'required',
            'batas_waktu' => 'required',
        ]);

        $tb_paket = tb_paket::where('id', $request->id_paket)->first();

        $diskon = $request->diskon / 100;
        $harga_terdiskon = $tb_paket->harga * $diskon;
        $total_harga = $tb_paket->harga - $harga_terdiskon;
        $total_harga *= $request->qty;
        $total_harga += $request->pajak;
        $total_harga += $request->biaya_tambahan;

        $tr = tb_transaksi::all()->count();
        $tr += 1;
        $kode_inv = 'TR-'.$tr;

        $tb_transaksi = tb_transaksi::create([
            'id_outlet' => $request->id_outlet,
            'id_member' => $request->id_member,
            'id_user' => $request->user()->id,
            'kode_inv' => $kode_inv,
            'tanggal' => $request->tanggal,
            'batas_waktu' => $request->batas_waktu,
            'biaya_tambahan' => $request->biaya_tambahan,
            'diskon' => $diskon,
            'pajak' => $request->pajak,
            'total_harga' => $total_harga,
            'status' => 'baru',
            'dibayar' => 'belum_dibayar'
        ]);

        if($tb_transaksi){
            tb_detail_transaksi::create([
                'id_transaksi' => $tb_transaksi->id,
                'id_paket' => $request->id_paket,
                'qty' => $request->qty,
                'keterangan' => $request->keterangan
            ]);
        }

        if($request->user()->role == "admin"){
            return redirect()->route('transaksi.index');
        }else{
            return redirect()->route('transaksi_kasir.index');
        }
    }

    public function show($id)
    {
        $tb_transaksi = tb_transaksi::findOrFail($id);
        $outlet = tb_outlet::all();
        $member = tb_member::all();
        $paket = tb_paket::all();
        $data = array(
            'outlet' => $outlet,
            'member' => $member,
            'paket' => $paket,
            'transaksi' => $tb_transaksi
        );
        return view('transaksi.show', $data);
    }

    public function edit($id)
    {
        $tb_transaksi = tb_transaksi::findOrFail($id);
        $outlet = tb_outlet::all();
        $member = tb_member::all();
        $paket = tb_paket::all();
        $data = array(
            'outlet' => $outlet,
            'member' => $member,
            'paket' => $paket,
            'transaksi' => $tb_transaksi
        );
        return view('transaksi.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $tb_transaksi = tb_transaksi::findOrFail($id);
        $this->validate($request, [
            'id_member' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
            'diskon' => 'required',
            'pajak' => 'required',
            'biaya_tambahan' => 'required',
            'tanggal' => 'required',
            'batas_waktu' => 'required',
        ]);

        $tb_paket = tb_paket::where('id', $request->id_paket)->first();

        if($tb_transaksi->diskon != $request->diskon){
            $diskon = $request->diskon / 100;
        }else{
            $diskon = $request->diskon;
        }
        $harga_terdiskon = $tb_paket->harga * $diskon;
        $total_harga = $tb_paket->harga - $harga_terdiskon;
        $total_harga *= $request->qty;
        $total_harga += $request->pajak;
        $total_harga += $request->biaya_tambahan;

        $tb_transaksi->update([
            'id_outlet' => $request->id_outlet,
            'id_member' => $request->id_member,
            'id_user' => $request->user()->id,
            'tanggal' => $request->tanggal,
            'batas_waktu' => $request->batas_waktu,
            'biaya_tambahan' => $request->biaya_tambahan,
            'diskon' => $diskon,
            'pajak' => $request->pajak,
            'total_harga' => $total_harga
        ]);

        $tb_detail_transaksi = tb_detail_transaksi::where('id_transaksi', $id)->first();
        $tb_detail_transaksi->update([
            'id_transaksi' => $tb_transaksi->id,
            'id_paket' => $request->id_paket,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan
        ]);

        if($request->user()->role == "admin"){
            return redirect()->route('transaksi.index');
        }else{
            return redirect()->route('transaksi_kasir.index');
        }
    }

    public function destroy(Request $request, $id)
    {
        $tb_transaksi = tb_transaksi::findOrFail($id);
        $tb_transaksi->delete();
        return redirect()->back();
    }

    public function dibayar(Request $request, $id)
    {
        $transaksi = tb_transaksi::findOrFail($id);
        if($request->dibayar == "dibayar"){
            $transaksi->update(['dibayar' => 'dibayar']);
        }else{
            $transaksi->update(['belum_dibayar' => 'belum_dibayar']);
        }
        return redirect()->back();
    }
    
    public function status(Request $request, $id)
    {
        $transaksi = tb_transaksi::findOrFail($id);
    
        if($request->status == "baru"){
            $transaksi->update(['status' => 'baru']);
        }elseif($request->status == "proses"){
            $transaksi->update(['status' => 'proses']);
        }elseif($request->status == "selesai"){
            $transaksi->update(['status' => 'selesai']);
        }else{
            $transaksi->update(['status' => 'diambil']);
        }
        return redirect()->back();
    }
}
