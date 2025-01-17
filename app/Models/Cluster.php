<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $table = 'cluster';
    protected $fillable = [
        'company_id',
        'nm_cluster',
        'jumlah_port',
        'jenis',
        'server_id',
        'koordinat',
        'alamat',
    ];

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class,'cluster_id','id');
    }
    public function server()
    {
        return $this->belongsTo(Server::class,'server_id','id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
