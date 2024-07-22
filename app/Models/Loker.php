<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loker extends Model
{
    use HasFactory;
    protected $table = 'loker';
    protected $primaryKey = 'id';
    protected $fillable = ['jabatan', 'alamat', 'jenis_waktu_pekerjaan', 'deskripsi', 'status'];

    public function perusahaan () : BelongsTo {
        return $this->belongsTo(Perusahaan::class);
    }

    public function lamaran () : HasMany {
        return $this->hasMany(Lamaran::class);
    }
}
