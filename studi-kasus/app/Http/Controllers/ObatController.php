<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObatStoreRequest;
use App\Http\Requests\ObatUpdateRequest;
use App\Models\Obat;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $obats = Obat::paginate(10);
        return view('admin.obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ObatStoreRequest $request): RedirectResponse

    {
        $obat = new Obat();
        $obat->nama_obat = $request->nama_obat;
        $obat->harga = $request->harga;
        $obat->save();

        notyf()->success("Created Successfully!");

        return to_route('admin.obat.index');
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
    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ObatUpdateRequest $request, Obat $obat)
    {
        $obat->nama_obat = $request->nama_obat;
        $obat->harga = $request->harga;
        $obat->save();

        notyf()->success("Updated Successfully!");

        return to_route('admin.obat.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        try {

            $obat->delete();
            notyf()->success('Deleted Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("obat Language Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
