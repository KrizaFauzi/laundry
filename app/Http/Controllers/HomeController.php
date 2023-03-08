<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\View;
use App\Models\tb_paket;
use App\Models\tb_member;
use App\Models\tb_outlet;
use App\Models\tb_transaksi;
use App\Models\tb_detail_transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transaksi = tb_transaksi::all();
        $data = array(
            'transaksi' => $transaksi
        );
        return view('home', $data)->with('no', 0);
    }

    public function laporan(Request $request)
    {
        $transaksi = tb_transaksi::all();
        $data = array(
            'transaksi' => $transaksi,
            'no' => 0
        );
        $pdf = PDF::loadView('transaksi.laporan', $data);
        return $pdf->download('laporan.pdf');
    }

}
