<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'data_perusahaan';
    protected $primaryKey = 'id_data_perusahaan';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($Model) {
            $prefix = 'P';
            $lastRecord = self::orderBy('id_data_perusahaan', 'desc')->first();

            $lastNumber = $lastRecord ? intval(substr($lastRecord->id_data_perusahaan, strlen($prefix))) : 0;
            $newNumber = $lastNumber + 1;

            $Model->id_data_perusahaan = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        });
    }

    public function user () :BelongsTo {
        return $this->belongsTo(User::class, 'username');
    }

    public function loker () : HasMany {
        return $this->hasMany(Loker::class, 'id_data_perusahaan');
    }
}
