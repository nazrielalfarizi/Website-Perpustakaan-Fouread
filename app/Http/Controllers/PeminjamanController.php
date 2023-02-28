<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    public function accept(Request $request)
    {
        $peminjaman = Peminjaman::with('buku')->find($request['id']);
        $peminjaman->update([
            'status' => 'Dipinjam'
        ]);
        return redirect()->route('peminjaman.index')->with('success', 'Berhasil meminjamkan: '. $peminjaman->buku->judul);
    }

    public function filterBulan(Request $request)
    {
        $bulan = $request->month;
        Peminjaman::query()->where('tanggal', NULL)->update([
            'status' => 'Dikembalikan',
        ]);
        return view('Pages.Admin.Peminjaman.FilterBulan', [
            'title' => 'Peminjaman Bulan ' . \Carbon\Carbon::create()->month($bulan)->isoFormat('MMMM'),
            'peminjamen' => Peminjaman::whereMonth('tanggal', $bulan)->get(),
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }

    public function createPengembalian(Peminjaman $peminjaman)
    {
        return view('Pages.Admin.Peminjaman.CreatePengembalian', [
            'title' => 'Tambah Data Pengembalian',
            'peminjaman' => $peminjaman,
        ]);
    }

    public function storePengembalian(Request $request)
    {
        $validatedData = $request->validate([
            'peminjaman_id' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'max:255',
        ]);

        $validatedData['tanggal'] = Carbon::now();

        Pengembalian::create($validatedData);

        Peminjaman::query()->where('id', $request->peminjaman_id)->update([
            'tanggal' => NULL,
        ]); // Is This Right?

        Alert::success('Data Pengembalian Berhasil Ditambahkan!');

        return redirect('/peminjaman');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Peminjaman::query()->where('tanggal', NULL)->update([
            'status' => 'Dikembalikan',
        ]);
        if (Auth::user()->role != 'admin') {
            $peminjaman = Peminjaman::where('user_id', Auth::user()->id)
            -> where('status', 'Dipinjam')->get();
            $peminjaman->sortBy('tanggal', SORT_NATURAL, false);
        } else {
            $peminjaman = Peminjaman::all();
        }
        return view('Pages.Admin.Peminjaman.Index', [
            'title' => 'Data Peminjaman',
            'peminjamen' => $peminjaman,
            // 'user' => User::class,
            'bulan' => Peminjaman::select(DB::raw("(DATE_FORMAT(created_at, '%m')) as month"))
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m')"))
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('Pages.Admin.Peminjaman.Create', [
            'title' => 'Tambah Data Peminjaman',
            'users' => User::query()->where('role', '=', 'siswa')->orWhere('role', '=', 'guru')->get(),
            'buku' => Buku::where('id', $id)->first(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        if ($request['satuanTanggal'] == 'hari') {
            $validatedData['tanggal'] = Carbon::now()->addDays($request['tanggal']);
        } elseif ($request['satuanTanggal'] == 'minggu') {
            $validatedData['tanggal'] = Carbon::now()->addWeeks($request['tanggal']);
        } elseif ($request['satuanTanggal'] == 'bulan') {
            $validatedData['tanggal'] = Carbon::now()->addMonths($request['tanggal']);
        }
        

        $validatedData['arsip'] = $validatedData['jumlah'];

        if ($validatedData['jumlah'] <= Buku::find($validatedData['buku_id'])->stok) {
            Peminjaman::create($validatedData);
            Alert::toast('Buku Berhasil Dipinjam!', 'success');
            return redirect('/peminjaman');
        }
        Alert::toast('Buku Gagal Dipinjam!', 'failed');
        return redirect('/peminjaman');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        Peminjaman::destroy($peminjaman->id);

        Alert::toast('Data Peminjaman Berhasil Dihapus!', 'success');

        return back();
    }


}
