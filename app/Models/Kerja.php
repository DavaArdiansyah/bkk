<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kerja extends Model
{
    use HasFactory;

    protected $table = 'pengalaman_kerja';
    protected $primaryKey = 'id_pengalaman_kerja';
    protected $keyType = 'string';
    protected $incrementing = false;
    public $timestamps = false;
    protected $guard = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($Model) {
            $prefix = 'PK';
            $lastRecord = self::orderBy('id_pengalaman_kerja', 'desc')->first();

            $lastNumber = $lastRecord ? intval(substr($lastRecord->id_pengalaman_kerja, strlen($prefix))) : 0;
            $newNumber = $lastNumber + 1;

            $Model->id_pengalaman_kerja = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        });
    }

    public function alumni () : BelongsTo {
        return $this->belongsTo(Alumni::class, 'nik');
    }
}
