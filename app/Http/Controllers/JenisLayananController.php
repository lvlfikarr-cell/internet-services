<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisLayanan;


class JenisLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisLayanans = JenisLayanan::all();
        return view('jenis_layanan.index', compact('jenisLayanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis_layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        JenisLayanan::create($request->all());

        return redirect()->route('jenis-layanan.index')
            ->with('success', 'Jenis layanan berhasil ditambahkan');
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
    public function edit(JenisLayanan $jenis_layanan)
    {
        return view('jenis_layanan.edit', compact('jenis_layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisLayanan $jenis_layanan)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        $jenis_layanan->update($request->all());

        return redirect()
            ->route('jenis-layanan.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisLayanan $jenis_layanan)
    {
        $jenis_layanan->delete();

        return redirect()
            ->route('jenis-layanan.index')
            ->with('success', 'Data berhasil dihapus');
    }

}
