<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title }} - Perpustakaan</title>
    <link rel="shortcut icon" href="{{ asset('logosmkn4.png') }}" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>
<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div
                    class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('logosmkn4.png') }}" alt="logo" width="100">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>{{ $title }}</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="/guestbook">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="user_id">Nama</label>
                                            <input id="user_id" name="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" value="{{ Auth::user()->name }}" disabled>
                                            <input id="user_id" name="user_id" type="hidden" class="form-control @error('user_id') is-invalid @enderror" value="{{ Auth::user()->id }}">
                                            @error('user_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                        <input id="kelas_id" name="kelas_id" type="text" class="form-control @error('kelas_id') is-invalid @enderror" value="{{ $kelas->nama }}" disabled>
                                        <input id="kelas_id" name="kelas_id" type="hidden" class="form-control @error('kelas_id') is-invalid @enderror" value="{{ $kelas->id }}">
                                        @error('kelas_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <div class="input-group">
                                        <input name="tanggal" id="tanggal" type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tujuam">Tujuan</label>
                                    <div class="input-group">
                                        <input name="tujuan" id="tujuan" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        {{ $title }}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="simple-footer">
                        &copy; 2022 SMKN 4 Bandung. All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>