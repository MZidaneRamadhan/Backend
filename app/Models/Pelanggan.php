<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggan extends Model
{
    use SoftDeletes;
    protected $table = 'pelanggan';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'company_id',
        'nomor_layanan',
        'name',
        'telp',
        'email',
        'status_tagihan',
        'server_id',
        'cluster_id',
        'paket_internet_id',
        'login',
        'sales',
        'no_ktp',
        'tgl_pemasangan',
        'tgl_jatuh_tempo',
        'biaya_pemasangan',
        'foto',
        'koordinat',
        'metode_langganan',
        'biaya_tambahan_id',
        'diskon_id',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'desa',
    ];

    public function server()
    {
        return $this->belongsTo(Server::class,'server_id','id');
    }
    public function cluster()
    {
        return $this->belongsTo(Cluster::class,'cluster_id','id');
    }
    public function paket()
    {
        return $this->belongsTo(PaketInternet::class,'paket_internet_id','id');
    }
    public function diskon()
    {
        return $this->belongsTo(Discount::class,'diskon_id','id');
    }
    public function biayatambahan()
    {
        return $this->belongsTo(BiayaTambahan::class,'biaya_tambahan_id','id');
    }
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class,'pelanggan_id','id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
