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