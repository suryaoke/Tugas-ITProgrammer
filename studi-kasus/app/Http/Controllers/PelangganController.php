<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelangganStoreRequest;
use App\Http\Requests\PelangganUpdateRequest;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pelanggans = Pelanggan::paginate(10);
        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PelangganStoreRequest $request): RedirectResponse

    {
        $pelanggan = new Pelanggan();
        $pelanggan->nama = $request->nama;
        $pelanggan->jenis_kelamin = $request->jenis_kelamin;
        $pelanggan->tanggal_lahir = $request->tanggal_lahir;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->no_telepon = $request->no_telepon;
        $pelanggan->save();

        notyf()->success("Created Successfully!");

        return to_route('admin.pelanggan.index');
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
    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PelangganUpdateRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->nama = $request->nama;
        $pelanggan->jenis_kelamin = $request->jenis_kelamin;
        $pelanggan->tanggal_lahir = $request->tanggal_lahir;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->no_telepon = $request->no_telepon;
        $pelanggan->save();

        notyf()->success("Updated Successfully!");

        return to_route('admin.pelanggan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        try {

            $pelanggan->delete();
            notyf()->success('Deleted Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("pelanggan Language Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
