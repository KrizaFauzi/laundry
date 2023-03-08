@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title">Dashboard</h4>
            <div class="card-tools">
                <a href="{{ route('home.laporan') }}" class="btn btn-sm btn-info">
                Print Laporan
                </a>
            </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th width="50px">No</th>
                    <th>Kode Invoice</th>
                    <th>Paket</th>
                    <th>Outlet</th>
                    <th>Member</th>
                    <th>User</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($transaksi as $transaksi)
                    <tr>
                    <td>
                    {{ ++$no }}
                    </td>
                    <td>
                    {{ $transaksi->kode_inv }}
                    </td>
                    <td>
                    {{ $transaksi->detail_transaksi->paket->nama_paket }}
                    </td>
                    <td>
                        @if (isset($transaksi->outlet))
                        {{ $transaksi->outlet->nama }}
                        @else
                        <p>Tidak Ke Outlet manapun</p>
                        @endif
                    </td>
                    <td>
                    {{ $transaksi->member->nama }}
                    </td>
                    <td>
                    {{ $transaksi->user->name }}
                    </td>
                    <td>
                    {{ $transaksi->status }}
                    </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection