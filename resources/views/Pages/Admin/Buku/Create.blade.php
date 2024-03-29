@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back">
            <a href="/buku" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="/buku" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-4">
                                <label for="judul"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="judul" name="judul" type="text"
                                        class="form-control @error('judul') is-invalid @enderror" autofocus
                                        value="{{ old('judul') }}" required>
                                    @error('judul')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="jumlah"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="jumlah" name="jumlah" type="number"
                                        class="form-control @error('jumlah') is-invalid @enderror"
                                        value="{{ old('jumlah') }}" required min="1">
                                    @error('jumlah')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cover</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Pilih Gambar</label>
                                        <input type="file" name="cover" id="image-upload" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="kategori"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="kategori[]" id="kategori" class="form-control selectric" multiple=""
                                        required>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori[]')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sinopsis</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea name="sinopsis" class="summernote-simple">{{ old('sinopsis') }}</textarea>
                                    @error('sinopsis')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="penerbit"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penerbit</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="penerbit" name="penerbit" type="text"
                                        class="form-control @error('penerbit') is-invalid @enderror"
                                        value="{{ old('penerbit') }}">
                                    @error('penerbit')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="pengarang" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                    Pengarang</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="pengarang" name="pengarang" type="text"
                                        class="form-control @error('pengarang') is-invalid @enderror"
                                        value="{{ old('pengarang') }}">
                                    @error('pengarang')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="halaman"
                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Halaman</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="halaman" name="halaman" type="number"
                                        class="form-control @error('halaman') is-invalid @enderror"
                                        value="{{ old('halaman') }}" min="1">
                                    @error('halaman')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="tahunRilis" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun
                                    Rilis</label>
                                <div class="col-sm-12 col-md-7">
                                    <input id="tahunRilis" name="tahunRilis" type="number" max="9999" min="1"
                                        class="form-control @error('tahunRilis') is-invalid @enderror"
                                        value="{{ old('tahunRilis') }}">
                                    @error('tahunRilis')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 text-center">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button type="submit" class="btn btn-outline-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
