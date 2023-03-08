<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_member extends Model
{
    use HasFactory;
    protected $table = 'tb_members';
    protected $fillable = [
        'nama',
        'alamat',
        'jenis_kelamin',
        'tlp'
    ];
}
