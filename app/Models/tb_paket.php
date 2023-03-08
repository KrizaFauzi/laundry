<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tb_outlet;

class tb_paket extends Model
{
    use HasFactory;
    protected $table = 'tb_pakets';
    protected $fillable = [
        'id_outlet', 
        'jenis',
        'nama_paket',
        'harga'
    ];

    public function outlet(){
        return $this->belongsTo(tb_outlet::class, 'id_outlet');
    }
}
