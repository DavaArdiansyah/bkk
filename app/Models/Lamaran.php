<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function lowonganPekerjaan () : BelongsTo {
        return $this->belongsTo(Loker::class, 'id_lowongan_pekerjaan');
    }
}
