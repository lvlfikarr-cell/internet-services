<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\JenisLayanan;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanans = JenisLayanan::all();
        return view('transaksi.index', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $layanan = JenisLayanan::findOrFail($id);
        return view('transaksi.create', compact('layanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'jenis_layanan_id' => 'required|exists:jenis_layanans,id',
            'tanggal_berlangganan' => 'required|date',
        ]);

        Transaksi::create([
            'user_id' => session('user_id'),
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'jenis_layanan_id' => $request->jenis_layanan_id,
            'tanggal_berlangganan' => $request->tanggal_berlangganan,
        ]);


        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function riwayat()
    {
        $transaksis = Transaksi::with('jenisLayanan')
            ->where('user_id', session('user_id'))
            ->get();

        return view('transaksi.riwayat', compact('transaksis'));
    }

}


