<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'data_alumni';
    protected $primaryKey = 'nik';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function user () :BelongsTo {
        return $this->belongsTo(User::class, 'username');
    }

    public function pendidikanFormal () : HasMany {
        return $this->hasMany(PendidikanFormal::class, 'nik');
    }

    public function pendidikanNonFormal () : HasMany {
        return $this->hasMany(PendidikanNonFormal::class, 'nik');
    }

    public function kerja () : HasMany {
        return $this->hasMany(Kerja::class, 'nik');
    }

    public function lamaran () : HasMany {
        return $this->hasMany(Lamaran::class, 'nik');
    }

    public function lamaran () : HasMany {
        return $this->hasMany(Lamaran::class, 'nik');
    }
}
