@extends('Layouts.AppLayout')
@section('Pages')
<div class="section-header d-flex justify-content-between">
    <h1>{{ $title }}</h1>
    <div class="d-flex justify-content-end">
        @can('admin')            
        <a href="/exportGuestBook" class="btn btn-outline-success mr-1">Export</a>
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
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guestbook as $guestbooks)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $guestbooks->user->name }}</td>
                                        <td class="text-center">{{ $guestbooks->kelas->nama }}</td>
                                        <td class="text-center">{{ $guestbooks->tanggal }}</td>
                                        <td class="text-center">{{ $guestbooks->tujuan }}</td>
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