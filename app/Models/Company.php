<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
        protected $table = 'companies';
        protected $fillable = [
            'nm_company',
            'email',
            'logo_company',
            'alamat',
            'telp',
            'website',
        ];

    public function user()
    {
        return $this->hasMany(User::class,'company_id','id');
    }
    public function server()
    {
        return $this->hasMany(Server::class,'company_id','id');
    }
    public function paket()
    {
        return $this->hasMany(PaketInternet::class,'company_id','id');
    }
    public function cluster()
    {
        return $this->hasMany(Cluster::class,'company_id','id');
    }
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class,'company_id','id');
    }
    public function diskon()
    {
        return $this->hasMany(Discount::class,'company_id','id');
    }
    public function biayatambahan()
    {
        return $this->hasMany(BiayaTambahan::class,'company_id','id');
    }
}
