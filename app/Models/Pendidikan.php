<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendidikan extends Model
{
    use HasFactory;
    protected $table = 'pendidikan';
    protected $fillable = ['id_alumni', 'nama_lembaga', 'alamat', 'gelar', 'bidang_studi', 'tahun_awal', 'tahun_akhir', 'nilai', 'pengalaman_kerja', 'deskripsi'];

    public function alumni () : BelongsTo {
        return $this->belongsTo(Alumni::class);
    }
}
