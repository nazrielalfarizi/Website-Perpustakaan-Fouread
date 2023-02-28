<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\GuestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\GuestBookExport;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class GuestBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guestbook = GuestBook::with('user')->get();
        return view('Pages.Admin.GuestBook.Show', [
            'title' => 'Data Tamu Perpustakaan',
            'guestbook' => $guestbook,
        ]);
    }

    public function export()
    {
        return Excel::download(new GuestBookExport, 'data-tamu.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Admin.GuestBook.Create', [
            'title' => 'Isi Data Tamu',
            'kelas' => Kelas::where('id', Auth::user()->kelas_id)->first(),
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
            'kelas_id' => 'required',
            'tujuan' => 'max:1000',
        ]);

        $validatedData['tanggal'] = Carbon::now();

        GuestBook::create($validatedData);

        Alert::success('Data Tamu berhasil ditambahkan', 'Selamat Datang di Perpustakaan! 😀');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
