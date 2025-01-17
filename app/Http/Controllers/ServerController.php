<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServerController extends Controller
{
    public function index()  {
        $server = Server::where('company_id',Auth::user()->company_id)->get();

        return response()->json($server);
    }

    public function store(Request $request)  {
        $validator = Validator::make($request->all(), [
            'lokasi_server'     => 'required',
            'alamat'     => 'required',
            'jatuh_tempo'     => 'required',
            'pajak'     => 'required',
            'status'     => 'required',
        ]);
        $user = Auth::user()->company_id;
        $server = Server::create([
            'company_id'  => $user,
            'lokasi_server'  => $request->lokasi_server,
            'alamat'  => $request->alamat,
            'jatuh_tempo'  => $request->jatuh_tempo,
            'pajak'  => $request->pajak,
            'status'  => $request->status,
        ]);

        return response()->json($server);
    }

    public function update(Request $request, $id)  {
        $validated = $request->validate([
            'lokasi_server'     => 'required',
            'alamat'     => 'required',
            'jatuh_tempo'     => 'required',
            'pajak'     => 'required',
            'status'     => 'required',
        ]);

        $server = Server::findOrFail($id);
        $server->update([
            'lokasi_server' => $request->lokasi_server,
            'alamat' => $request->alamat,
            'jatuh_tempo' => $request->jatuh_tempo,
            'pajak' => $request->pajak,
            'status' => $request->status,
        ]);

        return response()->json($server);
    }

    public function destroy($id)
    {
        $server = Server::findOrFail($id);
        $server->delete();
        return response()->json($server);
    }
    public function trashed()
    {
        return Server::onlyTrashed()->get(); // Data yang terhapus
    }

    public function restore($id)
    {
        $server = Server::withTrashed()->find($id);
        if ($server) {
            $server->restore();
            return response()->json(['message' => 'Data berhasil dipulihkan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }

    public function forceDelete($id)
    {
        $server = Server::withTrashed()->find($id);
        if ($server) {
            $server->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
