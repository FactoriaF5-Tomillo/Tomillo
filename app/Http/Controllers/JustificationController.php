<?php

namespace App\Http\Controllers;

use App\Justification;

use App\User;
use App\Policies\JustificationPolicy;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Policies\CoursePolicy;

class JustificationController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $justifications = Justification::all();
        return view('justification.index', compact('justifications'));
    }

    public function getJustifications()
    {
        $justifications = Justification::all();
        return $justifications;
    }

    public function getJustification(Justification $justification)
    {
        return $justification;
    }

    public function show(Justification $justification)
    {
        $this->authorize('view', User::class);
        return view('justification.show', compact('justification'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', User::class);
        return view('justification.create');
    }


    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $justification = Justification::create($request->all());
        return $justification;
    }

    public function uploadFile(Request $request)
    {
        $justification = Justification::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $request->file,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => Auth::user()->id
        ]);



        $file = $request->file('file');

        $file_name = $justification->upload_file($file);

        $justification->update([
            'file' => $file_name,
        ]);

        return redirect('/home');
    }

    public function edit(Justification $justification)
    {
        $this->authorize('update', $justification);
        return view('justification.edit', compact('justification'));
    }

    public function update(Request $request, Justification $justification)
    {
        $this->authorize('update', $justification);
        $justification->update($request->all());
        $justifications = Justification::all();
        return $justifications;
    }

    public function approveJustification(Justification $justification, Request $request)
    {
        $justification->update([
            "approval" => true
        ]);
        return $justification;
    }

    public function destroy(Justification $justification)
    {
        $justification->delete();
        return Justification::all();
    }

    public function download($file_name) {
        $file_path = public_path('storage/uploads/'. $file_name);
        return response()->download($file_path);
    }
}
