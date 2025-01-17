<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaris extends Model
{
    use SoftDeletes;
    protected $table = 'inventaris';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'company_id',
        'nm_barang',
        'harga_pembelian',
        'tgl_pembelian',
        'pelanggan_id',
        'server_id',
        'alamat_ip',
        'alamat_mac',
        'status',
        'ket',
    ];

    public function server()
    {
        return $this->belongsTo(Server::class,'server_id','id');
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class,'pelanggan_id','id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
