<?php

namespace App\Models;

use App\Models\User;
use App\Models\tb_detail_transaksi;
use App\Models\tb_outlet;
use App\Models\tb_member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tb_transaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $fillable = [
        'id_outlet',
        'id_member',
        'id_user',
        'kode_inv',
        'tanggal',
        'batas_waktu',
        'tanggal_bayar',
        'biaya_tambahan',
        'diskon',
        'pajak',
        'total_harga',
        'status',
        'dibayar',
    ];

    public function outlet(){
        return $this->belongsTo(tb_outlet::class, 'id_outlet');
    }

    public function member(){
        return $this->belongsTo(tb_member::class, 'id_member');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detail_transaksi(){
        return $this->hasOne(tb_detail_transaksi::class, 'id_transaksi');
    }
}
