@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col col-lg-6 col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Edit Paket</h3>
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
            <form action="{{ route('paket.update', $paket->id) }}" method="post">
              @csrf
              {{ method_field('patch') }}
              <div class="form-group mb-2">
                <label for="outlet">Outlet</label>
                <select class="form-select" id="outlet" aria-label="Default select example" name="id_outlet">
                    <option selected>Pilih Outlet</option>
                    @foreach ($outlet as $outlet)
                        <option value="{{ $outlet->id }}" {{ $paket->id_outlet == $outlet->id ? 'selected': ''}}>{{ $outlet->nama }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group mb-2">
                <label for="jenis">Jenis</label>
                <select class="form-select" id="jenis" aria-label="Default select example" name="jenis">
                    <option selected>Pilih Jenis</option>
                    <option value="kiloan" {{ $paket->jenis == "kiloan" ? 'selected' : '' }}>Kiloan</option>
                    <option value="selimut" {{ $paket->jenis == "selimut" ? 'selected' : '' }}>Selimut</option>
                    <option value="bed_cover" {{ $paket->jenis == "bed_cover" ? 'selected' : '' }}>Bed Cover</option>
                    <option value="kaos" {{ $paket->jenis == "kaos" ? 'selected' : '' }}>Kaos</option>
                    <option value="lain" {{ $paket->jenis == "lain" ? 'selected' : '' }}>Lain</option>
                </select>
              </div>
              <div class="form-group mb-2">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" class="form-control" value="{{ $paket->nama_paket }}">
              </div>
              <div class="form-group mb-4">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $paket->harga }}">
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