@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <h1>{{ $title }}</h1>
        <div class="d-flex justify-content-end">
            @if ($peminjamen->count() > 0)
                <form action="/peminjaman/filterBulan" id="dbForm" class="mr-3" method="get">
                    <select onchange="autoSubmit()" name="month" id="month" class="form-control">
                        <option hidden disabled selected>Pilih Bulan...</option>
                        @foreach ($bulan as $bulan)
                            <option value="{{ $bulan->month }}">
                                {{ \Carbon\Carbon::create()->month($bulan->month)->isoFormat('MMMM') }}</option>
                        @endforeach
                    </select>
                </form>
            @endif
            @can('admin')            
            <a href="/exportPeminjaman" class="btn btn-outline-success mr-1">Export</a>
            @endcan
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th class="text-center">Judul Buku</th>
                                        <th class="text-center">Nama Peminjam</th>
                                        <th class="text-center">Jumlah Peminjaman</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Harus Dikembalikan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjamen as $peminjaman)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $peminjaman->buku->judul }}</td>
                                            <td class="text-center">{{ $peminjaman->user->name }}</td>
                                            <td class="text-center">{{ $peminjaman->arsip }}</td>
                                            <td class="text-center"><span
                                                    class="badge rounded-pill text-white {{ $peminjaman->status == 'Dipinjam' ? 'bg-warning' : ($peminjaman->status == 'Dikembalikan' ? 'bg-success' : ($peminjaman->status == 'Penyerahan' ? 'bg-secondary' : 'bg-danger')) }}">{{ $peminjaman->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ $peminjaman->tanggal == null ? '' : \Carbon\Carbon::parse($peminjaman->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                            </td>
                                            <td class="text-right d-flex justify-content-center">
                                                @can('admin')
                                                <a href="/pengembalian/create/{{ $peminjaman->id }}"
                                                    class="btn btn-icon btn-outline-primary mr-1"><i
                                                        class="fas fa-exchange-alt"></i></a>
                                                @endcan
                                                <form action="/peminjaman/{{ $peminjaman->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        class="btn btn-icon btn-outline-danger show_confirm"><i
                                                            class="fas fa-trash"></i></button>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
    $(document).on('click', '.show_confirm', function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          Swal.fire({
            title: 'PERINGATAN!',
            text: 'Yakin ingin menghapus data peminjaman?',
            icon: 'warning',
            showCancelButton:true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin',
            cancelButtonText: 'Batal',
        })
          .then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Hapus!',
                    'Data Berhasil di hapus',
                    'success'
                )
                setTimeout(() => {
                    form.submit();
                }, 100);
            }
          });
      });
  
</script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
