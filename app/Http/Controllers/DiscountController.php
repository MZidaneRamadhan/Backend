<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function index()  {
        $dis = Discount::with('pelanggan')->where('company_id',Auth::user()->company_id)->get();

        return response()->json($dis);
    }

    public function store(Request $request)  {
        $validator = Validator::make($request->all(), [
            'nm_diskon'     => 'required',
            'tipe'     => 'required',
            'jumlah'     => 'nullable',
            'persen'     => 'nullable',
            'deskripsi'     => 'nullable',
        ]);

        $user = Auth::user()->company_id;
        $dis = Discount::create([
            'company_id'  => $user,
            'nm_diskon'  => $request->nm_diskon,
            'tipe'  => $request->tipe,
            'jumlah'  => $request->jumlah,
            'persen'  => $request->persen,
            'deskripsi'  => $request->deskripsi,
        ]);

        return response()->json($dis);
    }

    public function update(Request $request, $id)  {
        $validated = $request->validate([
            'nm_diskon'     => 'required',
            'tipe'     => 'required',
            'jumlah'     => 'nullable',
            'persen'     => 'nullable',
            'deskripsi'     => 'nullable',
        ]);

        $dis = Discount::findOrFail($id);
        $dis->update([
            'nm_diskon' => $request->nm_diskon,
            'tipe' => $request->tipe,
            'jumlah' => $request->jumlah,
            'persen' => $request->persen,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json($dis);
    }

    public function destroy($id)
    {
        $dis = Discount::findOrFail($id);
        $dis->delete();
        return response()->json($dis);
    }
    public function trashed()
    {
        return Discount::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $dis = Discount::withTrashed()->find($id);
        if ($dis) {
            $dis->restore();
            return response()->json(['message' => 'Data berhasil dipulihkan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.']);
    }

    public function forceDelete($id)
    {
        $dis = Discount::withTrashed()->find($id);
        if ($dis) {
            $dis->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.']);
    }
}
