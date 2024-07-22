<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'pengguna';
    protected $fillable = ['email', 'password', 'role'];

    public function aktivitas () : HasMany {
        return $this->hasMany(Aktivitas::class);
    }
    
    public function alumni () : HasOne {
        return $this->hasOne(Alumni::class);
    }

    public function perusahaan () : HasOne {
        return $this->hasOne(Perusahaan::class);
    }
}
