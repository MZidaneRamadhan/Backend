<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()  {
        $comp = Company::with('user')->where('company_id',Auth::user()->company_id)->get();

        return response()->json($comp);
    }
    public function update(Request $request, $id)  {
        $validated = $request->validate([
            'nm_company'     => 'required',
            'email'     => 'required',
            'logo_company'     => 'required',
            'alamat'     => 'nullable',
            'telp'     => 'required',
            'website'     => 'nullable',
        ]);

        $comp = Company::findOrFail($id);
        $comp->update([
            'nm_company'  => $request->nm_company,
            'email'  => $request->email,
            'logo_company'  => $request->logo_company,
            'alamat'  => $request->alamat,
            'telp'  => $request->telp,
            'website'  => $request->website,
        ]);

        return response()->json($comp);
    }
}
