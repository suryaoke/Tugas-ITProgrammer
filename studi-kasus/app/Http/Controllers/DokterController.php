<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokterStoreRequest;
use App\Http\Requests\DokterUpdateRequest;
use App\Models\Dokter;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $dokters = Dokter::paginate(10);
        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DokterStoreRequest $request): RedirectResponse

    {
        $dokter = new Dokter();
        $dokter->nama = $request->nama;
        $dokter->spesialisasi = $request->spesialisasi;
        $dokter->no_telepon = $request->no_telepon;
        $dokter->save();

        notyf()->success("Created Successfully!");

        return to_route('admin.dokter.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
        return view('admin.dokter.edit', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DokterUpdateRequest $request, Dokter $dokter)
    {
        $dokter->nama = $request->nama;
        $dokter->spesialisasi = $request->spesialisasi;
        $dokter->no_telepon = $request->no_telepon;
        $dokter->save();

        notyf()->success("Updated Successfully!");

        return to_route('admin.dokter.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        try {

            $dokter->delete();
            notyf()->success('Deleted Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("dokter Language Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
