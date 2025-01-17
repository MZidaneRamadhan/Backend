<?php

namespace App\Http\Controllers;

use App\Models\BiayaTambahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BiayaTambahanController extends Controller
{
    public function index()  {
        $fee = BiayaTambahan::with('pelanggan')->where('company_id',Auth::user()->company_id)->get();

        return response()->json($fee);
    }

    public function store(Request $request)  {
        $validator = Validator::make($request->all(), [
            'nm_biaya'     => 'required',
            'jumlah'     => 'required',
            'deskripsi'     => 'required',
        ]);

        $user = Auth::user()->company_id;
        $fee = BiayaTambahan::create([
            'company_id'  => $user,
            'nm_biaya'  => $request->nm_biaya,
            'jumlah'  => $request->jumlah,
            'deskripsi'  => $request->deskripsi,
        ]);

        return response()->json($fee);
    }

    public function update(Request $request, $id)  {
        $validated = $request->validate([
            'nm_biaya'     => 'required',
            'jumlah'     => 'required',
            'deskripsi'     => 'required',
        ]);

        $fee = BiayaTambahan::findOrFail($id);
        $fee->update([
            'nm_biaya' => $request->nm_biaya,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json($fee);
    }

    public function destroy($id)
    {
        $fee = BiayaTambahan::findOrFail($id);
        $fee->delete();
        return response()->json($fee);
    }
    public function trashed()
    {
        return BiayaTambahan::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $fee = BiayaTambahan::withTrashed()->find($id);
        if ($fee) {
            $fee->restore();
            return response()->json(['message' => 'Data berhasil dipulihkan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.']);
    }

    public function forceDelete($id)
    {
        $fee = BiayaTambahan::withTrashed()->find($id);
        if ($fee) {
            $fee->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.']);
    }
}
