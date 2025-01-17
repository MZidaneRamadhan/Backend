<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClusterController extends Controller
{
    public function index()  {
        $cluster = Cluster::withCount('pelanggan')->where('company_id',Auth::user()->company_id)->get();
        // $usedport= Cluster::with('pelanggan')->where('cluster_id')->count();

        return response()->json($cluster);
    }

    public function store(Request $request)  {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'jumlah_port'     => 'required',
            'jenis'     => 'required',
            'server_id'     => 'required|',
            'koordinat'     => 'required',
            'alamat'     => 'required',
        ]);
        $user = Auth::user()->company_id;
        $cluster = Cluster::create([
            'company_id'  => $user,
            'name'  => $request->name,
            'jumlah_port'  => $request->jumlah_port,
            'jenis'  => $request->jenis,
            'server_id'  => $request->server_id,
            'koordinat'  => $request->koordinat,
            'alamat'  => $request->alamat,
        ]);

        return response()->json(['cluster' => $cluster]);
    }

    public function update(Request $request, $id)  {
        $validated = $request->validate([
            'name'     => 'required',
            'jumlah_port'     => 'required',
            'jatuh_tempo'     => 'required',
            'server_id'     => 'required',
            'koordinat'     => 'required',
            'alamat'     => 'required',
        ]);

        $cluster = Cluster::findOrFail($id);
        $cluster->update([
            'name' => $request->name,
            'jumlah_port' => $request->jumlah_port,
            'jatuh_tempo' => $request->jatuh_tempo,
            'server_id' => $request->server_id,
            'koordinat' => $request->koordinat,
            'alamat' => $request->alamat,
        ]);

        return response()->json($cluster);
    }

    public function destroy($id)
    {
        $cluster = Cluster::findOrFail($id);
        $cluster->delete();
        return response()->json($cluster);
    }
    public function trashed()
    {
        return Cluster::onlyTrashed()->get(); // Data yang terhapus
    }

    public function restore($id)
    {
        $cluster = Cluster::withTrashed()->find($id);
        if ($cluster) {
            $cluster->restore();
            return response()->json(['message' => 'Data berhasil dipulihkan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }

    public function forceDelete($id)
    {
        $cluster = Cluster::withTrashed()->find($id);
        if ($cluster) {
            $cluster->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
