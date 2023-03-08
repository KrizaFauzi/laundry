@extends('layouts.app')
@section('content')
<div class="container">
    <!-- table kategori -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Member</h4>
            <div class="card-tools">
              <a href="{{ Auth::user()->role == "admin" ? route('member.create') : route('pelanggan.create') }}" class="btn btn-sm btn-primary">
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
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Tlp</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($tb_member as $member)
                  <tr>
                    <td>
                    {{ ++$no }}
                    </td>
                    <td>
                    {{ $member->nama }}
                    </td>
                    <td>
                    {{ $member->jenis_kelamin == 'L' ? "Laki laki" : '' }}
                    {{ $member->jenis_kelamin == 'P' ? "Perempuan" : '' }}
                    </td>
                    <td>
                    {{ $member->alamat }}
                    </td>
                    <td>
                    {{ $member->tlp }}
                    </td>
                    <td>
                      <a href="{{ Auth::user()->role == "admin" ? route('member.edit', $member->id) : route('pelanggan.edit', $member->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                        Edit
                      </a>
                      <form action="{{ Auth::user()->role == "admin" ? route('member.destroy', $member->id) : route('pelanggan.destroy', $member->id) }}" method="post" style="display:inline;">
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