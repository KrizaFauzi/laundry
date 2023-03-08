@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-12 ">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Transaksi</h3>
            <div class="card-tools">
              <a href="{{ Auth::user()->role == 'admin' ? route('transaksi.index') : route('transaksi_kasir.index') }}" class="btn btn-sm btn-danger">
                Tutup
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
            <form action="{{ Auth::user()->role == 'admin' ? route('transaksi.update', $transaksi->id) : route('transaksi_kasir.update', $transaksi->id)  }}" method='POST'>
            @csrf
            @method('put')
            <div class="row mb-2">
                <div class="form-group col-4">
                    <label for="outlet">Outlet</label>
                    <select class="form-select" id="id_outlet" aria-label="Default select example" name="id_outlet">
                        <option value="">Pilih Outlet</option>
                        @foreach ($outlet as $outlet)
                        <option value="{{ $outlet->id }}" {{ $transaksi->id_outlet == $outlet->id ? 'selected' : '' }}>{{ $outlet->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="member">Member</label>
                    <select class="form-select" id="member" aria-label="Default select example" name="id_member">
                        <option value="">Pilih Member</option>
                        @foreach ($member as $member)
                        <option value="{{ $member->id }}" {{ $transaksi->id_member == $member->id ? 'selected' : '' }} >{{ $member->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="paket">paket</label>
                    <select class="form-select" id="paket" aria-label="Default select example" name="id_paket">
                        <option value="">Pilih Paket</option>
                        @foreach ($paket as $paket)
                        <option value="{{ $paket->id }}" {{ $transaksi->detail_transaksi->id_paket == $paket->id ? 'selected' : '' }}>{{ $paket->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group col-3">
                    <label for="qty">Quantity</label>
                    <input type="text" name="qty" id="qty" class="form-control" value="{{ $transaksi->detail_transaksi->qty }}">
                </div>
                <div class="form-group col-3">
                    <label for="diskon">Diskon</label>
                    <input type="numeric" name="diskon" id="diskon" class="form-control" value="{{ $transaksi->diskon }}">
                </div>
                <div class="form-group col-3">
                    <label for="pajak">Pajak</label>
                    <input type="numeric" name="pajak" id="pajak" class="form-control" value="{{ $transaksi->pajak }}">
                </div>
                <div class="form-group col-3">
                    <label for="biaya_tambahan">Biaya Tambahan</label>
                    <input type="numeric" name="biaya_tambahan" id="biaya_tambahan" class="form-control" value="{{ $transaksi->biaya_tambahan }}">
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group col-6">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $transaksi->tanggal }}">
                </div>
                <div class="form-group col-6">
                    <label for="batas_waktu">Batas Waktu</label>
                    <input type="date" name="batas_waktu" id="batas_waktu" class="form-control" value="{{ $transaksi->batas_waktu }}">
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group col-12">
                    <label for="keterangan">Keterangan</label>
                    <textarea type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $transaksi->detail_transaksi->keterangan }}">{{ $transaksi->detail_transaksi->keterangan }}</textarea>
                </div>
            </div>
              <div class="form-group mb-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-warning">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection