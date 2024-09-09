<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loker extends Model
{
    use HasFactory;

    protected $table = 'lowongan_pekerjaan';
    protected $primaryKey = 'id_lowongan_pekerjaan';
    protected $keyType = 'string';
    protected $incrementing = false;
    const CREATED_AT = false;
    const UPDATED_AT = 'waktu';
    protected $guard = [];
    protected $cast = [
        'tanggal_akhir' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($Model) {
            $prefix = 'LP';
            $lastRecord = self::orderBy('id_lowongan_pekerjaan', 'desc')->first();

            $lastNumber = $lastRecord ? intval(substr($lastRecord->id_lowongan_pekerjaan, strlen($prefix))) : 0;
            $newNumber = $lastNumber + 1;

            $Model->id_lowongan_pekerjaan = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        });
    }

    public function perusahaan () : BelongsTo {
        return $this->belongsTo(Perusahaan::class, 'id_data_perusahaan');
    }
}
