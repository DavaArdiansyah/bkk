<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lamaran extends Model
{
    use HasFactory;

    protected $table = 'lamaran';
    protected $primaryKey = 'id_lamaran';
    const CREATED_AT = null;
    const UPDATED_AT = 'waktu';
    protected $guarded = [];

    public function perusahaan () : BelongsTo {
        return $this->belongsTo(Perusahaan::class, 'id_data_perusahaan');
    }

    public function loker () : BelongsTo {
        return $this->belongsTo(Loker::class, 'id_lowongan_pekerjaan');
    }

    public function alumni () : BelongsTo {
        return $this->belongsTo(Alumni::class, 'nik');
    }

    public function fileLamaran () : HasMany {
        return $this->hasMany(FileLamaran::class, 'id_lamaran');
    }
}
