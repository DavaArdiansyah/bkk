<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kerja extends Model
{
    use HasFactory;
    protected $table = 'kerja';
    protected $fillable = ['id_alumni', 'jabatan', 'jenis_waktu_pekerjaan', 'nama_perusahaan', 'alamat', 'tahun_awal', 'tahun_akhir', 'deskripsi'];

    public function alumni () : BelongsTo {
        return $this->belongsTo(Alumni::class);
    }
}
