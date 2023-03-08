@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-12 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Outlet</h3>
            <div class="card-tools">
              <a href="{{ route('outlet.index') }}" class="btn btn-sm btn-danger">
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
            <form action="{{ route('outlet.store') }}" method='POST'>
            @csrf
              <div class="form-group mb-2">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">
              </div>
              <div class="form-group mb-2">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control">
              </div>
              <div class="form-group mb-4">
                <label for="tlp">No Telp</label>
                <input type="text" name="tlp" id="tlp" class="form-control">
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