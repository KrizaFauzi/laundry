@extends('layouts.app')
@section('content')
<div class="container">
    <!-- table kategori -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Outlet</h4>
            <div class="card-tools">
              <a href="{{ route('outlet.create') }}" class="btn btn-sm btn-primary">
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
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tlp</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($tb_outlet as $outlet)
                  <tr>
                    <td>
                    {{ ++$no }}
                    </td>
                    <td>
                    {{ $outlet->nama }}
                    </td>
                    <td>
                    {{ $outlet->alamat }}
                    </td>
                    <td>
                    {{ $outlet->tlp }}
                    </td>
                    <td>
                      <a href="{{ route('outlet.edit', $outlet->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                        Edit
                      </a>
                      <form action="{{ route('outlet.destroy', $outlet->id) }}" method="post" style="display:inline;">
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