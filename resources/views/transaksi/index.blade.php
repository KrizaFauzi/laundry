@extends('layouts.app')
@section('content')
<div class="container">
    <!-- table kategori -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Transaksi</h4>
            <div class="card-tools">
              <a href="{{ Auth::user()->role == 'admin' ? route('transaksi.create') : route('transaksi_kasir.create') }}" class="btn btn-sm btn-primary">
                Baru
              </a>
              <a href="{{ route('home.laporan') }}" class="btn btn-sm btn-info">
                Print Laporan
              </a>
            </div>
          </div>
          <div class="card-body">
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-warning">{{ $error }}</div>
            @endforeach
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if(count($errors) > 0)
              @foreach($errors->all() as $error)<div class="alert alert-warning">{{ $error }}</div>
              @endforeach
              @endif
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
                    <th>Action</th>
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
                    <td>
                      <a href="{{ Auth::user()->role == 'admin' ? route("transaksi.edit", $transaksi->id) : route("transaksi_kasir.edit", $transaksi->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                        Edit
                      </a>
                      <a href="{{ Auth::user()->role == 'admin' ? route("transaksi.show", $transaksi->id) : route("transaksi_kasir.show", $transaksi->id) }}" class="btn btn-sm btn-info mr-2 mb-2">
                        Detail
                      </a>
                      <form action="{{ Auth::user()->role == 'admin' ? route("transaksi.destroy", $transaksi->id) : route("transaksi_kasir.destroy", $transaksi->id) }}" method="post" style="display:inline;">
                        @csrf
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-sm btn-danger mb-2">
                          Hapus
                        </button>                    
                      </form>
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