<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_outlet extends Model
{
    use HasFactory;
    protected $table = 'tb_outlets';
    protected $fillable = [
        'nama',
        'alamat',
        'tlp'
    ];
}
