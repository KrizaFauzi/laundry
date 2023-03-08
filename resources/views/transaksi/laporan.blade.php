<style>
  .container {
    padding: 15px;
  }

  .row {
    margin-right: -15px;
    margin-left: -15px;
  }

  .col {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
  }

  .card {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
  }

  .card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #f7f7f7;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  }

  .card-title {
    margin-bottom: 0;
    font-size: 1.25rem;
  }

  .card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
  }

  .table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
    border-collapse: collapse;
  }

  .table-bordered {
    border: 1px solid #dee2e6;
  }

  .table-bordered th,
  .table-bordered td {
    border: 1px solid #dee2e6;
  }

  .table-bordered thead th,
  .table-bordered thead td {
    border-bottom-width: 2px;
  }

  .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
  }

  .table th,
  .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
  }

  .table tbody + tbody {
    border-top: 2px solid #dee2e6;
  }
</style>
<div class="container">
  <!-- table kategori -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Transaksi</h4>
        </div>
        <div class="card-body">
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