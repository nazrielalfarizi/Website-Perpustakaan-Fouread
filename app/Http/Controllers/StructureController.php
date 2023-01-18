<?php
 
namespace App\Http\Controllers;
 
use App\Models\Structure;
 
class StructureController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('profilelibrary', [
            'structure' => Structure::findOrFail($id)
        ]);
    }
}