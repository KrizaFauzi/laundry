@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ganti Status</div>
                    <div class="card-tools">
                        <a href="{{ Auth::user()->role == 'admin' ? route('transaksi.index') : route('transaksi_kasir.index')}}" class="btn btn-sm btn-danger">
                          Tutup
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="form-group col-6 mb-2">
                            <form action="{{ Auth::user()->role == 'admin' ? route('transaksi.status', $transaksi->id) : route('transaksi_kasir.status', $transaksi->id) }}" method='POST'>
                                @csrf
                                @method('put')
                                <label for="status">Status</label>
                                <select class="form-select" id="status" aria-label="Default select example" name="status">
                                    <option value="baru" {{ $transaksi->status == "baru" ? 'selected' : '' }}>Baru</option>
                                    <option value="proses" {{ $transaksi->status == "proses" ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ $transaksi->status == "selesai" ? 'selected' : '' }}>Selesai</option>
                                    <option value="diambil" {{ $transaksi->status == "diambil" ? 'selected' : '' }}>Diambil</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </form>
                        </div>
                        <div class="form-group col-6">
                            <form action="{{ Auth::user()->role == 'admin' ? route('transaksi.dibayar', $transaksi->id) : route('transaksi_kasir.dibayar', $transaksi->id) }}" method='POST'>
                                @csrf
                                @method('put')
                                <label for="dibayar">Dibayar</label>
                                <select class="form-select" id="dibayar" aria-label="Default select example" name="dibayar">
                                    <option value="dibayar" {{ $transaksi->dibayar == "dibayar" ? 'selected' : '' }}>dibayar</option>
                                    <option value="belum_dibayar" {{ $transaksi->dibayar == "belum_dibayar" ? 'selected' : '' }}>Belum Dibayar</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-12 ">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Transaksi</h3>
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
            <div class="row mb-2">
                <div class="form-group col-4">
                    <label for="outlet">Outlet</label>
                    @if (isset($transaksi->outlet))    
                        <input type="text" name="qty" id="qty" class="form-control" value="{{ $transaksi->outlet->nama }}" readonly>
                    @else
                        <input type="text" name="qty" id="qty" class="form-control" value="{{ $transaksi->outlet }}" readonly>
                    @endif
                </div>
                <div class="form-group col-4">
                    <label for="member">Member</label>
                    <input type="text" name="qty" id="qty" class="form-control" value="{{ $transaksi->member->nama }}" readonly>
                </div>
                <div class="form-group col-4">
                    <label for="paket">paket</label>
                    <input type="text" name="qty" id="qty" class="form-control" value="{{ $transaksi->detail_transaksi->paket->nama_paket }}" readonly>
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group col-3">
                    <label for="qty">Quantity</label>
                    <input type="text" name="qty" id="qty" class="form-control" value="{{ $transaksi->detail_transaksi->qty }}" readonly>
                </div>
                <div class="form-group col-3">
                    <label for="diskon">Diskon</label>
                    <input type="numeric" name="diskon" id="diskon" class="form-control" value="{{ $transaksi->diskon }}" readonly>
                </div>
                <div class="form-group col-3">
                    <label for="pajak">Pajak</label>
                    <input type="numeric" name="pajak" id="pajak" class="form-control" value="{{ $transaksi->pajak }}" readonly>
                </div>
                <div class="form-group col-3">
                    <label for="biaya_tambahan">Biaya Tambahan</label>
                    <input type="numeric" name="biaya_tambahan" id="biaya_tambahan" class="form-control" value="{{ $transaksi->biaya_tambahan }}" readonly>
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group col-6">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $transaksi->tanggal }}" readonly>
                </div>
                <div class="form-group col-6">
                    <label for="batas_waktu">Batas Waktu</label>
                    <input type="date" name="batas_waktu" id="batas_waktu" class="form-control" value="{{ $transaksi->batas_waktu }}" readonly>
                </div>
            </div>
            <div class="row mb-4">
                <div class="form-group col-12">
                    <label for="keterangan">Keterangan</label>
                    <textarea type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $transaksi->detail_transaksi->keterangan }}" readonly>{{ $transaksi->detail_transaksi->keterangan }}</textarea>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection