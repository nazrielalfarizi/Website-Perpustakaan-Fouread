@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back">
            <a href="/peminjaman" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <form method="POST" action="/peminjaman">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                            <label for="user_id">Peminjaman</label>
                                <input id="user_id" name="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" value="{{ Auth::user()->name }}" disabled>
                                <input id="user_id" name="user_id" type="hidden" class="form-control @error('user_id') is-invalid @enderror" value="{{ Auth::user()->id }}">
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="buku-id">Judul Buku</label>
                                <input id="buku-id" name="buku_id" type="text" class="form-control @error('buku_id') is-invalid @enderror" value="{{ $buku->judul }}" disabled>
                        <input id="buku-id" name="buku_id" type="hidden" class="form-control @error('buku_id') is-invalid @enderror" value="{{ $buku->id }}">
                                @error('buku-id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah Peminjaman</label>
                                <input id="jumlah" name="jumlah" type="number"
                                    class="form-control @error('jumlah') is-invalid @enderror"
                                    value="{{ old('jumlah') }}" placeholder="Jumlah Peminjaman">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Lama Peminjaman</label>
                                <div class="input-group">
                                    <input name="tanggal" value="7" id="tanggal" type="number" class="form-control">
                                    <select name="satuanTanggal" class="custom-select" id="inputGroupSelect05">
                                        <option value="hari" selected>Hari</option>
                                        <option value="minggu">Minggu</option>
                                        <option value="bulan">Bulan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-outline-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
