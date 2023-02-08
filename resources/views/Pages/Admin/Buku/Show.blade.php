@extends('Layouts.AppLayout')
@section('Pages')
<div class="section-header">
    <div class="section-header-back">
        <a href="/buku" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{ $title }}</h1>

</div>
<div class="section-body">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td class="text-center">Judul</td>
                <td>{{ $buku->judul }}</td>
            </tr>
            <tr>
                <td class="text-center">Stok</td>
                <td>{{ $buku->stok }}</td>
            </tr>
            <tr>
                <td class="text-center">Sinopsis</td>
                <td>{!! $buku->sinopsis !!}</td>
            </tr>
            <tr>
                <td class="text-center">Penerbit</td>
                <td>{{ $buku->penerbit }}</td>
            </tr>
            <tr>
                <td class="text-center">Pengarang</td>
                <td>{{ $buku->pengarang }}</td>
            </tr>
            <tr>
                <td class="text-center">Jumlah Halaman</td>
                <td>{{ $buku->halaman }}</td>
            </tr>
            <tr>
                <td class="text-center">Cover Buku</td>
                <td>
                    <img style="width: 9rem;" class="p-3 img-fluid rounded" src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul }}">
                </td>
            </tr>
            <tr>
                <td class="text-center">Tahun Rilis</td>
                <td>{{ $buku->tahunRilis }}</td>
            </tr>
            <tr>
                <td class="text-center">Keterangan</td>
                <td>
                    @if($buku->stok > 0)
                    <label class="text-center badge rounded-pill text-white bg-success">Tersedia</label>
                    @else
                    <label class="text-center badge rounded-pill text-white bg-warning">Tidak Tersedia</label>
                    @endif
                </td>
                <!-- <td><span class="badge rounded-pill text-white {{ $buku->keterangan == 'Tidak Tersedia' ? 'bg-warning' : ($buku->keterangan == 'Tersedia' ? 'bg-success' : ($peminjaman->status == 'Penyerahan' ? 'bg-secondary' : 'bg-danger')) }}">{{ $buku->keterangan }}</span></td> -->
            </tr>
            <tr>
                <td class="text-center">Kategori Buku</td>
                @can('admin')
                <td>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            @can('admin')
                            @foreach ($buku->kategoris as $kategori)
                            <form action="/buku/{{ $buku->id }}/kategori/{{ $kategori->id }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-icon icon-left mr-3" onclick="return confirm('Anda Yakin akan Melakukan Aksi Ini?')">
                                    <i class="fas fa-trash"></i> {{ $kategori->nama }}
                                </button>
                            </form>
                            @endforeach
                        </div>
                        <form action="/buku/kategori" id="dbForm" method="POST">
                            @csrf
                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                            <select onchange="autoSubmit()" name="kategori_id" class="form-control">
                                <option hidden disabled selected>Tambah Kategori</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            @endcan
                        </form>
                    </div>
                </td>
                @endcan
                @foreach ($buku ->kategoris as $kategori)
                <td>{{ $kategori->nama }}</td>
                @endforeach
            </tr>
            @can('siswa')
            <tr>
                <td class="text-center"><a href="{{url('peminjaman/create/' . $buku->id)}}" class="btn btn-icon btn-outline-success">Pinjam Buku</a></td>
            </tr>
            @endcan
        </tbody>
    </table>
</div>
<script>
    function autoSubmit() {
        var formObject = document.forms['dbForm'];
        formObject.submit();
    }
</script>
@endsection