<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $fillable = [
        'company_id',
        'nm_diskon',
        'tipe',
        'jumlah',
        'persen',
        'deskripsi',
    ];
    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class,'diskon_id','id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
