<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketInternet extends Model
{
    protected $table = 'paket_internet';
    protected $fillable = [
        'company_id',
        'nm_paket',
        'bandwidth',
        'harga',
    ];

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class,'server_id','id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
