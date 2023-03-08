@extends('layouts.app')
@section('content')
<div class="container">
    <!-- table kategori -->
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">User</h4>
            <div class="card-tools">
              <a href="{{ route('register') }}" class="btn btn-sm btn-primary">
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
                    <th>Nama User</th>
                    <th>Role User</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($user as $user)
                  <tr>
                    <td>
                    {{ ++$no }}
                    </td>
                    <td>
                    {{ $user->name }}
                    </td>
                    <td>
                    {{ $user->role }}
                    </td>
                    <td>
                    {{ $user->email }}
                    </td>
                    <td>
                      <a href="{{ route("user.edit", $user->id) }}" class="btn btn-sm btn-primary mr-2 mb-2">
                        Edit
                      </a>
                      <form action="{{ route('user.delete', $user->id) }}" method="post" style="display:inline;">
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