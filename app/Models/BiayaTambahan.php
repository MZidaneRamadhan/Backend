<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiayaTambahan extends Model
{
    protected $table = 'biaya_tambahan';
    protected $fillable = [
        'company_id',
        'nm_biaya',
        'jumlah',
        'deskripsi',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class,'biaya_tambahan_id','id');
    }
}
