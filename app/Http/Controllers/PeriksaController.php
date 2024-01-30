<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokterNoHp = session('no_hp');
        $dokter = Dokter::where('no_hp', $dokterNoHp)->first();

        $daftarPolis = DaftarPoli::whereHas('jadwal', function ($query) use ($dokter) {
            $query->where('id_dokter', $dokter->id);
        })->get();

        return view('dokter.periksa-pasien', compact('daftarPolis', 'dokter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokterNoHp = session('no_hp');
        $dokter = Dokter::where('no_hp', $dokterNoHp)->first();

        $daftarPoli = DaftarPoli::find($id);
        $obats = Obat::all();

        return view('dokter.edit-periksa', compact('daftarPoli', 'obats', 'dokter'));
    }

    public function updatePeriksa(Request $request, $id)
    {
        $request->validate(
            [
                'id_daftar_poli' => 'required',
                'tgl_periksa' => 'required',
                'biaya_periksa' => 'required|numeric|digits_between:1,10',
                'catatan' => 'required',
            ],
            [
                'id_daftar_poli.required' => 'ID Daftar Poli tidak boleh kosong',
                'tgl_periksa.required' => 'Tanggal Periksa tidak boleh kosong',
                'biaya_periksa.required' => 'Biaya tidak boleh kosong',
                'biaya_periksa.numeric' => 'Biaya harus berupa angka',
                'biaya_periksa.digits_between' => 'Biaya maksimal 10 digit',
                'catatan.required' => 'Catatan tidak boleh kosong',
            ]
        );
        // Tambah Jasa Dokter
        $totalBiaya = 150000 + $request->biaya_periksa;

        $daftarPoli = DaftarPoli::find($request->id_daftar_poli);
        $periksa = Periksa::create([
            'id_daftar_poli' => $daftarPoli->id,
            'tgl_periksa' => $request->tgl_periksa,
            'biaya_periksa' => $totalBiaya,
            'catatan' => $request->catatan,
        ]);
        $periksa->save();

        $dokterNoHp = session('no_hp');
        $dokter = Dokter::where('no_hp', $dokterNoHp)->first();

        $obatIds = json_decode($request->obat_ids);
        foreach ($obatIds as $obatId) {
            $detailPeriksa = DetailPeriksa::create([
                'id_dokter' => $dokter->id,
                'id_periksa' => $periksa->id,
                'id_obat' => $obatId,
            ]);
            $detailPeriksa->save();
        }

        return redirect()->route('periksapasien')->with('success', 'Data Periksa Berhasil Ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama' => 'required',
                'keluhan' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'keluhan.required' => 'Keluhan tidak boleh kosong',
            ]
        );
        $daftarPolis = DaftarPoli::find($id);
        $daftarPolis->update([
            'nama' => $request->nama,
            'keluhan' => $request->keluhan,
        ]);
        return redirect()->route('periksapasien')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
