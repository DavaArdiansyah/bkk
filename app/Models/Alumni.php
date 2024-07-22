<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumni extends Model
{
    use HasFactory;
    protected $table = 'alumni';
    protected $fillable = ['nama', 'jurusan', 'jenis_kelamin', 'tahun_lulus', 'alamat', 'keahlian', 'foto', 'deskripsi'];

    public function pengguna () : BelongsTo {
        return $this->belongsTo(Pengguna::class);
    }

    public function lamaran () : HasMany {
        return $this->hasMany(Lamaran::class);
    }

    public function pendidikan () : HasMany {
        return $this->hasMany(Pendidikan::class);
    }

    public function kerja () : HasMany {
        return $this->hasMany(kerja::class);
    }
}
