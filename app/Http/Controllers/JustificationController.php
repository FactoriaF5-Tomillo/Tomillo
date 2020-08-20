<?php

namespace App\Http\Controllers;

use App\Justification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class JustificationController extends Controller
{

    public function index()
    {   
        $justifications = Justification::all();
        return view('justification.index')->with(compact('justifications'));
    }
   

    public function create(Request $request)
    {
        $file = $request->file('File');
        // \Storage::disk('local')->put($file,  \File::get($file));
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Justification $justification)
    {
        //
    }

    public function edit(Justification $justification)
    {
        //
    }

  
    public function update(Request $request, Justification $justification)
    {
        //
    }


    public function destroy(Justification $justification)
    {
        //
    }
}
