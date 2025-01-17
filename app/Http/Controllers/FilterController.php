<?php

namespace App\Http\Controllers;

use App\Models\PaketInternet;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function provinsi(){
        return response()->json(Pelanggan::select("provinsi")->get());
    }
    public function kota(){
        return response()->json(Pelanggan::select("kota")->get());
    }
    public function kecamatan(){
        return response()->json(Pelanggan::select("kecamatan")->get());
    }
    public function desa(){
        return response()->json(Pelanggan::select("desa")->get());
    }
}
