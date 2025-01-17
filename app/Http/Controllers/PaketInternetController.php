<?php

namespace App\Http\Controllers;

use App\Models\PaketInternet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaketInternetController extends Controller
{
    public function index()  {
        $paket = PaketInternet::where('company_id',Auth::user()->company_id)->get();

        return response()->json($paket);
    }
    public function store(Request $request)  {
        $validator = Validator::make($request->all(), [
            'nm_paket'     => 'required',
            'bandwidth'     => 'required',
            'harga'     => 'required',
        ]);
        $user = Auth::user()->company_id;
        $paket = PaketInternet::create([
            'company_id'  => $user,
            'nm_paket'  => $request->nm_paket,
            'bandwidth'  => $request->bandwidth,
            'harga'  => $request->harga,
        ]);

        return response()->json($paket);
    }

    public function update(Request $request, $id)  {
        $validated = $request->validate([
            'nm_paket'     => 'required',
            'bandwidth'     => 'required',
            'harga'     => 'required',
        ]);

        $paket = PaketInternet::findOrFail($id);
        $paket->nm_paket = $request->nm_paket;
        $paket->bandwidth = $request->bandwidth;
        $paket->harga = $request->harga;

        $paket->save();

        return response()->json($paket);
    }
    public function destroy($id)
    {
        $paket = PaketInternet::findOrFail($id);
        $paket->delete();
        return response()->json($paket);
    }
    public function trashed()
    {
        return PaketInternet::onlyTrashed()->get(); // Data yang terhapus
    }

    public function restore($id)
    {
        $paket = PaketInternet::withTrashed()->find($id);
        if ($paket) {
            $paket->restore();
            return response()->json(['message' => 'Data berhasil dipulihkan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }

    public function forceDelete($id)
    {
        $paket = PaketInternet::withTrashed()->find($id);
        if ($paket) {
            $paket->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
