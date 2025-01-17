<?php

namespace App\Http\Controllers;

use App\Models\BiayaTambahan;
use App\Models\Cluster;
use App\Models\Discount;
use App\Models\PaketInternet;
use App\Models\Pelanggan;
use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $pelanggan = Pelanggan::with('server','paket')->where('company_id',Auth::user()->company_id)->get();
        if ($request->filled('paket')) {
            $pelanggan->whereHas('paket', function ($q) use ($request) {
                $q->where('paket_internet_id', $request->input('paket'));
            });
        }
        if ($request->filled('server')) {
            $pelanggan->whereHas('server', function ($q) use ($request) {
                $q->where('server_id', $request->input('server'));
            });
        }
        if ($request->filled('cluster')) {
            $pelanggan->whereHas('cluster', function ($q) use ($request) {
                $q->where('cluster_id', $request->input('cluster'));
            });
        }
        if ($request->filled('kecamatan')) {
            $pelanggan->where('kecamatan', $request->input('kecamatan'));
        }
        if ($request->filled('desa')) {
            $pelanggan->where('desa', $request->input('desa'));
        }
        if ($request->filled('status')) {
            $pelanggan->where('status_tagihan', $request->input('status'));
        }

        // Fetch the results and return them as JSON
        return response()->json($pelanggan->get(),200);

    }
    public function details($id)
    {
        $pelanggan = Pelanggan::with('cluster','server','paket','diskon','biayatambahan')->findOrFail($id);

        return response()->json($pelanggan);
    }
    public function create()
    {
        $server = Server::all();
        $cluster = Cluster::all();
        $paket = PaketInternet::all();
        $diskon = Discount::all();
        $fee = BiayaTambahan::all();

        return response()->json([
            'server'=> $server,
            'cluster'=> $cluster,
            'paket'=> $paket,
            'diskon'=> $diskon,
            'fee'=> $fee,
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required',
            'telp'               => 'required',
            'email'              => 'required',
            'status_tagihan'     => 'required',
            'server_id'          => 'required',
            'cluster_id'         => 'required',
            'paket_internet_id'  => 'required',
            'login'              => 'required',
            'sales'              => 'required',
            'no_ktp'             => 'required',
            'tgl_pemasangan'     => 'required',
            'tgl_jatuh_tempo'    => 'required',
            'biaya_pemasangan'   => 'nullable',
            'foto'               => 'nullable',
            'koordinat'          => 'nullable',
            'metode_langganan'   => 'required',
            'biaya_tambahan_id'  => 'nullable',
            'diskon_id'          => 'nullable',
            'alamat'             => 'required',
            'provinsi'           => 'nullable',
            'kota'               => 'nullable',
            'kecamatan'          => 'nullable',
            'desa'               => 'nullable',
        ]);


        $randomNumber = rand(100000000000, 999999999999);
        $servicenumber=$randomNumber;
        $company = Auth::user()->company_id;
        $pelanggan = Pelanggan::create([
            'company_id'  => $company,
            'nomor_layanan'  => $servicenumber,
            'name'  => $request->name,
            'telp'  => $request->telp,
            'email'  => $request->email,
            'status_tagihan'  => $request->status_tagihan,
            'server_id'  => $request->server_id,
            'cluster_id'  => $request->cluster_id,
            'paket_internet_id'  => $request->paket_internet_id,
            'login'  => $request->login,
            'sales'  => $request->sales,
            'no_ktp'  => $request->no_ktp,
            'tgl_pemasangan'  => $request->tgl_pemasangan,
            'tgl_jatuh_tempo'  => $request->tgl_jatuh_tempo,
            'biaya_pemasangan'  => $request->biaya_pemasangan,
            'foto'  => $request->foto,
            'koordinat'  => $request->koordinat,
            'metode_langganan'  => $request->metode_langganan,
            'biaya_tambahan_id'  => $request->biaya_tambahan_id,
            'diskon_id'  => $request->diskon_id,
            'alamat'  => $request->alamat,
            'provinsi'  => $request->provinsi,
            'kota'  => $request->kota,
            'kecamatan'  => $request->kecamatan,
            'desa'  => $request->desa,
        ]);

        return response()->json($pelanggan);
    }
    public function edit($id)
    {
        $pelanggan = Pelanggan::with('cluster','server','paket','diskon','biayatambahan')->findOrFail($id);

        return response()->json($pelanggan);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required',
            'telp'               => 'required',
            'email'              => 'required',
            'status_tagihan'     => 'required',
            'server_id'          => 'required',
            'cluster_id'         => 'required',
            'paket_internet_id'  => 'required',
            'login'              => 'required',
            'sales'              => 'required',
            'no_ktp'             => 'required',
            'tgl_pemasangan'     => 'required',
            'tgl_jatuh_tempo'    => 'required',
            'biaya_pemasangan'   => 'nullable',
            'foto'               => 'nullable',
            'koordinat'          => 'nullable',
            'metode_langganan'   => 'required',
            'biaya_tambahan_id'  => 'nullable',
            'diskon_id'          => 'nullable',
            'alamat'             => 'required',
            'provinsi'           => 'nullable',
            'kota'               => 'nullable',
            'kecamatan'          => 'nullable',
            'desa'               => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->update([
            'name'  => $request->name,
            'telp'  => $request->telp,
            'email'  => $request->email,
            'status_tagihan'  => $request->status_tagihan,
            'server_id'  => $request->server_id,
            'cluster_id'  => $request->cluster_id,
            'paket_internet_id'  => $request->paket_internet_id,
            'login'  => $request->login,
            'sales'  => $request->sales,
            'no_ktp'  => $request->no_ktp,
            'tgl_pemasangan'  => $request->tgl_pemasangan,
            'tgl_jatuh_tempo'  => $request->tgl_jatuh_tempo,
            'biaya_pemasangan'  => $request->biaya_pemasangan,
            'foto'  => $request->foto,
            'koordinat'  => $request->koordinat,
            'metode_langganan'  => $request->metode_langganan,
            'biaya_tambahan_id'  => $request->biaya_tambahan_id,
            'diskon_id'  => $request->diskon_id,
            'alamat'  => $request->alamat,
            'provinsi'  => $request->provinsi,
            'kota'  => $request->kota,
            'kecamatan'  => $request->kecamatan,
            'desa'  => $request->desa,
        ]);

        return response()->json(['message' => 'Data berhasil diperbarui', 'pelanggan' => $pelanggan]);
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return response()->json($pelanggan);
    }
    public function multiDeleted(Request $request)
    {
        $pelanggan = Pelanggan::destroy($request->id);
        return response()->json($pelanggan);
    }

    public function trashed()
    {
        return Pelanggan::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $pelanggan = Pelanggan::withTrashed()->find($id);
        if ($pelanggan) {
            $pelanggan->restore();
            return response()->json(['message' => 'Data berhasil dipulihkan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }

    public function forceDelete($id)
    {
        $pelanggan = Pelanggan::withTrashed()->find($id);
        if ($pelanggan) {
            $pelanggan->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
