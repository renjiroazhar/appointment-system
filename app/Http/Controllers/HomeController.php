<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function dokter()
    {
        $dokterNoHp = session('no_hp');
        $dokter = Dokter::where('no_hp', $dokterNoHp)->first();

        $jadwal = Jadwal::where('id', $dokter->id)->count();
        return view('dokter.dashboard', compact('dokter', 'jadwal'));
    }

    public function admin()
    {
        $dokters = Dokter::count();
        $pasiens = Pasien::count();
        $polis = Poli::count();
        $obats = Obat::count();
        return view('admin.dashboard', compact('dokters', 'pasiens', 'polis', 'obats'));
    }
}
