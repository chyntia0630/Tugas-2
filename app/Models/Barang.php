<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;


class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'nama',
        'harga',
        'stok',
    ];
}
