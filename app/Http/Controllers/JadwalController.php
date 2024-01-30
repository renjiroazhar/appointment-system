<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class JadwalController extends Controller
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
        $jadwal = Jadwal::where('id_dokter', $dokter->id)->get();

        return view('dokter.jadwal-praktik', compact('jadwal', 'dokter'));
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
        $dokterNoHp = session('no_hp');

        $dokter = Dokter::where('no_hp', $dokterNoHp)->first();

        $startTime = Carbon::parse($request->jam_mulai)->format('H:i:s');
        $endTime = Carbon::parse($request->jam_selesai)->format('H:i:s');
        $dokterId = $request->id_dokter;
        $hari = $request->hari;
        $aktif = 'T';

        if (strtotime($startTime) > strtotime($endTime)) {
            return redirect()->route('jadwalpraktik')->with('failed', 'Jam mulai tidak bisa lebih kecil dari jam selesai.');
        };

        $request->validate([
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ], [
            'id_dokter.required' => 'Dokter tidak boleh kosong',
            'hari.required' => 'Hari tidak boleh kosong',
            'jam_mulai.required' => 'Jam Mulai tidak boleh kosong',
            'jam_mulai.date_format' => 'Format Jam Mulai tidak valid',
            'jam_selesai.required' => 'Jam Selesai tidak boleh kosong',
            'jam_selesai.date_format' => 'Format Jam Selesai tidak valid',
            'jam_selesai.after' => 'Jam Selesai harus setelah Jam Mulai',
        ]);

        $overlapCount = Jadwal::where(function ($query) use ($startTime, $endTime, $dokterId, $hari, $dokter) {
            $query->where('id_dokter', '!=', $dokterId)
                ->whereHas('dokter', function ($q) use ($dokter) {
                    $q->where('id_poli', $dokter->id_poli);
                })
                ->where('hari', $hari)
                ->where(function ($q) use ($startTime, $endTime) {
                    $q->where(function ($qq) use ($startTime, $endTime) {
                        $qq->whereBetween('jam_mulai', [$startTime, $endTime])
                            ->orWhereBetween('jam_selesai', [$startTime, $endTime]);
                    })
                        ->orWhere(function ($qq) use ($startTime, $endTime) {
                            $qq->where('jam_mulai', '<', $endTime)
                                ->where('jam_selesai', '>', $startTime);
                        });
                });
        })->count();

        if ($overlapCount > 0) {
            return redirect()->route('jadwalpraktik')->with('failed', 'Jadwal tumpang tindih dengan jadwal dokter lain.');
        }

        $dokter = Dokter::find($dokterId);
        $jadwal = Jadwal::create([
            'id_dokter' => $dokter->id,
            'hari' => $hari,
            'jam_mulai' => $startTime,
            'jam_selesai' => $endTime,
            'aktif' => $aktif,
        ]);

        $jadwal->dokter()->associate($dokter);
        $jadwal->save();

        return redirect()->route('jadwalpraktik')->with('success', 'Jadwal berhasil ditambahkan');
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
        //
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
        $startTime = Carbon::parse($request->jam_mulai)->format('H:i:s');
        $endTime = Carbon::parse($request->jam_selesai)->format('H:i:s');
        $dokterId = $request->id_dokter;
        $hari = $request->hari;
        $aktif = $request->aktif;

        if (strtotime($startTime) > strtotime($endTime)) {
            return redirect()->route('jadwalpraktik')->with('failed', 'Jam mulai tidak bisa lebih kecil dari jam selesai.');
        };

        $request->validate([
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'aktif' => 'required',
        ], [
            'id_dokter.required' => 'Dokter tidak boleh kosong',
            'hari.required' => 'Hari tidak boleh kosong',
            'jam_mulai.required' => 'Jam Mulai tidak boleh kosong',
            'jam_mulai.date_format' => 'Format Jam Mulai tidak valid',
            'jam_selesai.required' => 'Jam Selesai tidak boleh kosong',
            'jam_selesai.date_format' => 'Format Jam Selesai tidak valid',
            'jam_selesai.after' => 'Jam Selesai harus setelah Jam Mulai',
            'aktif.required' => 'Status tidak boleh kosong',
        ]);

        $overlapCount = Jadwal::where(function ($query) use ($startTime, $endTime, $dokterId, $hari, $id) {
            $query->where('id_dokter', $dokterId)
                ->where('hari', $hari)
                ->where(function ($q) use ($startTime, $endTime) {
                    $q->whereBetween('jam_mulai', [$startTime, $endTime])
                        ->orWhereBetween('jam_selesai', [$startTime, $endTime]);
                });
            if ($id) {
                $query->where('id', '!=', $id);
            }
        })->count();

        if ($overlapCount > 0) {
            return redirect()->route('jadwalpraktik')->with('failed', 'Jadwal tumpang tindih dengan jadwal dokter lain.');
        }

        $dokter = Dokter::find($dokterId);
        $activeSchedule = Jadwal::where('id_dokter', $dokter->id)->where('aktif', 'Y')->first();
        $activeSchedule->update([
            'aktif' => 'T',
        ]);

        $jadwal = Jadwal::find($id);
        $jadwal->update([
            'id_dokter' => $dokter->id,
            'hari' => $hari,
            'jam_mulai' => $startTime,
            'jam_selesai' => $endTime,
            'aktif' => $aktif,
        ]);

        return redirect()->route('jadwalpraktik')->with('success', 'Jadwal berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jadwal::destroy($id);
        return redirect()->route('jadwalpraktik')->with('success', 'Jadwal berhasil dihapus');
    }
}
