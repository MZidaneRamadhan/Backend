<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InventarisController extends Controller
{
    public function index()  {
        $inventaris = Inventaris::where('company_id',Auth::user()->company_id)->get();

        return response()->json($inventaris);
    }
    public function store(Request $request)  {
        $validator = Validator::make($request->all(), [
            'nm_barang'     => 'required',
            'harga_pembelian'     => 'required',
            'tgl_pembelian'     => 'required',
            'pelanggan_id'     => 'nullable',
            'server_id'     => 'required',
            'alamat_ip'     => 'nullable',
            'alamat_mac'     => 'nullable',
            'status'     => 'required',
            'ket'     => 'nullable',
        ]);
        $user = Auth::user()->company_id;
        $inventaris = Inventaris::create([
            'company_id'  => $user,
            'nm_barang'  => $request->nm_barang,
            'harga_pembelian'  => $request->harga_pembelian,
            'tgl_pembelian'  => $request->tgl_pembelian,
            'pelanggan_id'  => $request->pelanggan_id,
            'server_id'  => $request->server_id,
            'alamat_ip'  => $request->alamat_ip,
            'alamat_mac'  => $request->alamat_mac,
            'status'  => $request->status,
            'ket'  => $request->ket,
        ]);

        return response()->json($inventaris);
    }

    public function update(Request $request, $id)  {
        $validated = $request->validate([
            'nm_barang'     => 'required',
            'harga_pembelian'     => 'required',
            'tgl_pembelian'     => 'required',
            'pelanggan_id'     => 'nullable',
            'server_id'     => 'required',
            'alamat_ip'     => 'nullable',
            'alamat_mac'     => 'nullable',
            'status'     => 'required',
            'ket'     => 'nullable',
        ]);

        $inventaris = Inventaris::findOrFail($id);
        $inventaris->update([
            'nm_barang'  => $request->nm_barang,
            'harga_pembelian'  => $request->harga_pembelian,
            'tgl_pembelian'  => $request->tgl_pembelian,
            'pelanggan_id'  => $request->pelanggan_id,
            'server_id'  => $request->server_id,
            'alamat_ip'  => $request->alamat_ip,
            'alamat_mac'  => $request->alamat_mac,
            'status'  => $request->status,
            'ket'  => $request->ket,
        ]);

        return response()->json($inventaris);
    }
    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();
        return response()->json($inventaris);
    }
    public function trashed()
    {
        return Inventaris::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $inventaris = Inventaris::withTrashed()->find($id);
        if ($inventaris) {
            $inventaris->restore();
            return response()->json(['message' => 'Data berhasil dipulihkan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }

    public function forceDelete($id)
    {
        $inventaris = Inventaris::withTrashed()->find($id);
        if ($inventaris) {
            $inventaris->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
