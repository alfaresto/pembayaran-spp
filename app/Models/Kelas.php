<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'nama_kelas', 'kompetensi_keahlian'
    // ];

    use HasFactory;
}
