<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'server';
    protected $fillable = [
        'company_id',
        'lokasi_server',
        'ip_router',
        'port_api',
        'alamat',
        'jatuh_tempo',
        'pajak',
        'username',
        'password',
        'status',
    ];

    public function cluster()
    {
        return $this->hasMany(Cluster::class,'server_id','id');
    }
    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class,'server_id','id');
    }
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class,'server_id','id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
