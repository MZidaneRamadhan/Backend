<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function index()  {
        $user = User::where('company_id',Auth::user()->company_id)->get();

        return response()->json($user);
    }

    public function store(Request $request)  {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'     => 'required',
            'password'     => 'required|password',
            'alamat'     => 'required',
            'telp'     => 'required',
            'login'     => 'required',
            'tgl_lahir'     => 'required|date',
            'tgl_bergabung'     => 'required|date',
            'jenis_kelamin'     => 'required',
            'kualifikasi_tertinggi'     => 'required',
            'role'     => 'required',
        ]);

        $user = Auth::user()->company_id;
        $user = User::create([
            'company_id'  => $user,
            'name'  => $request->name,
            'email'  => $request->email,
            'password'  => Hash::make($request->password),
            'alamat'  => $request->alamat,
            'telp'  => $request->telp,
            'login'  => $request->login,
            'tgl_lahir'  => $request->tgl_lahir,
            'tgl_bergabung'  => $request->tgl_bergabung,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'kualifikasi_tertinggi'  => $request->kualifikasi_tertinggi,
            'role'  => $request->role,
        ]);

        return response()->json($user);
    }

    public function edit($id)
    {
        $user = user::findOrFail($id);

        return response()->json($user);
    }

    public function update(Request $request, $id)  {
        $validated = $request->validate([
            'name'     => 'required',
            'email'     => 'required',
            'alamat'     => 'required',
            'telp'     => 'required',
            'login'     => 'required',
            'tgl_lahir'     => 'required|date',
            'tgl_bergabung'     => 'required|date',
            'jenis_kelamin'     => 'required',
            'kualifikasi_tertinggi'     => 'required',
            'role'     => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat'  => $request->alamat,
            'telp'  => $request->telp,
            'login'  => $request->login,
            'tgl_lahir'  => $request->tgl_lahir,
            'tgl_bergabung'  => $request->tgl_bergabung,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'kualifikasi_tertinggi'  => $request->kualifikasi_tertinggi,
            'role'  => $request->role,
        ]);

        return response()->json($user);
    }

    public function changePassword(Request $request)  {
        $validated = $request->validate([
            'current_password'     => 'required',
            'password'     => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password is incorrect.',
            ], 400);
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        // $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully.',
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json($user);
    }
    public function trashed()
    {
        return User::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            return response()->json(['message' => 'Data berhasil dipulihkan.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.']);
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->forceDelete();
            return response()->json(['message' => 'Data berhasil dihapus permanen.']);
        }
        return response()->json(['message' => 'Data tidak ditemukan.']);
    }
}
