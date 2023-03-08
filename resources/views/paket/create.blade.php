@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-12 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Paket</h3>
            <div class="card-tools">
              <a href="{{ route('paket.index') }}" class="btn btn-sm btn-danger">
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
            <form action="{{ route('paket.store') }}" method='POST'>
            @csrf
              <div class="form-group mb-2">
                <label for="outlet">Outlet</label>
                <select class="form-select" id="outlet" aria-label="Default select example" name="id_outlet">
                    <option selected>Pilih Outlet</option>
                    @foreach ($outlet as $outlet)
                        <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group mb-2">
                <label for="jenis">Jenis</label>
                <select class="form-select" id="jenis" aria-label="Default select example" name="jenis">
                    <option selected>Pilih Jenis</option>
                    <option value="kiloan">Kiloan</option>
                    <option value="selimut">Selimut</option>
                    <option value="bed_cover">Bed Cover</option>
                    <option value="kaos">Kaos</option>
                    <option value="lain">Lain</option>
                </select>
              </div>
              <div class="form-group mb-2">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" class="form-control">
              </div>
              <div class="form-group mb-4">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control">
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