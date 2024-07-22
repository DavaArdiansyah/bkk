<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaan';
    protected $fillable = ['nama', 'bidang_usaha', 'no_telepon', 'alamat', 'logo'];

    public function pengguna () : BelongsTo {
        return $this->belongsTo(Pengguna::class);
    }

    public function loker () : HasMany {
        return $this->hasMany(Loker::class);
    }
}
