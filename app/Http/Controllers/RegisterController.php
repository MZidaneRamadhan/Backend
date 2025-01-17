<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(Request $request)  {
        // dd($request->all());
        $validated = $request->validate([
            'nm_company'     => 'required',
            'name'     => 'required',
            'email'     => 'required|email',
            'password'     => 'required',
            'alamat'     => 'required',
            'telp'     => 'required',
            'website'     => 'nullable',
        ]);

        $company = Company::create([
            'nm_company'  => $request->nm_company,
            'email'  => $request->email,
            'alamat'  => $request->alamat,
            'telp'  => $request->telp,
            'website'  => $request->website,
        ]);


        $register = User::create([
            'company_id' => $company->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $company->alamat,
            'telp' => $company->telp,
            'login' => 'Izinkan',
            'tgl_bergabung' => now(),
            'role' => 'super_admin',
        ]);

        return response()->json($register,201);
    }
}
