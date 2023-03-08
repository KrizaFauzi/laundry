@extends('layouts.app')
@section('content')
<div class="container">
    <!-- table kategori -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Paket</h4>
            <div class="card-tools">
              <a href="{{ route('paket.create') }}" class="btn btn-sm btn-primary">
                Baru
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
                    <th>Jenis</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($tb_paket as $paket)
                  <tr>
                    <td>
                    {{ ++$no }}
                    </td>
                    <td>
                    {{ $paket->jenis }}
                    </td>
                    <td>
                    {{ $paket->nama_paket }}
                    </td>
                    <td>
                    {{ $paket->harga }}
                    </td>
                    <td>
                      <a href="{{ route('paket.edit', $paket->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                        Edit
                      </a>
                      <form action="{{ route('paket.destroy', $paket->id) }}" method="post" style="display:inline;">
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