@extends('Layouts.AppLayout')
@section('Pages')
<div class="section-header">
    <div class="section-header-back">
        <a href="/guestbook" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{ $title }}</h1>

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
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjamen as $peminjaman)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $guestbook->user->name }}</td>
                                        <td class="text-center">{{ $guestbook->kelas->name }}</td>
                                        <td class="text-center">{{ $guestbook->tanggal }}</td>
                                        <td class="text-center">{{ $guestbook->tujuan }}</td>
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

<script>
    function autoSubmit() {
        var formObject = document.forms['dbForm'];
        formObject.submit();
    }
</script>
@endsection