<table>
    <thead>
        <tr>
            <th>
                No.
            </th>
            <th >Judul Buku</th>
            <th >Nama Peminjam</th>
            <th >Jumlah Peminjaman</th>
            <th >Status</th>
            <th >Harus Dikembalikan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peminjamen as $peminjaman)
            <tr>
                <td >
                    {{ $loop->iteration }}
                </td>
                <td>{{ $peminjaman->buku->judul }}</td>
                <td >{{ $peminjaman->user->name }}</td>
                <td >{{ $peminjaman->arsip }}</td>
                <td ><span
                        class="badge rounded-pill text-white {{ $peminjaman->status == 'Dipinjam' ? 'bg-warning' : ($peminjaman->status == 'Dikembalikan' ? 'bg-success' : ($peminjaman->status == 'Penyerahan' ? 'bg-secondary' : 'bg-danger')) }}">{{ $peminjaman->status }}</span>
                </td>
                <td >
                    {{ $peminjaman->tanggal == null ? '' : \Carbon\Carbon::parse($peminjaman->tanggal)->isoFormat('dddd, D MMMM Y') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>