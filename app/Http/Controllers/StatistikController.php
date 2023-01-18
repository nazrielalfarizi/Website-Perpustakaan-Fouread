<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistik;

class StatistikController extends Controller
{
    public function index()
    {
        return view('Pages.Admin.Statistik.Index',[
            'title' => 'Dashboard'
        ]);
    }
}
