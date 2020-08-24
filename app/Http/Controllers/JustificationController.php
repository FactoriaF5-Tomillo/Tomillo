<?php

namespace App\Http\Controllers;

use App\Justification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class JustificationController extends Controller
{

    public function create(Request $request)
    {
        return view('justification.upload');
    }

    
    public function uploadFile(Request $request)
    {
        
        $file = $request->file('File');
        $extension = $file->extension();
        dd($extension);
        Storage::disk('local')->put('uploads',$file, \File::get($file));
        
        return $extension;
    }




    public function show(Justification $justification)
    {
        return view('justification.show', compact('justification')); 
    }


    public function update(Request $request, Justification $justification)
    {
        $justification->update($request->all());
        $justifications = Justification::all();
        return $justifications;
    }


   public function destroy(Justification $justification)
    {
        $justification->delete();
        return Justification::all();
    }
}
