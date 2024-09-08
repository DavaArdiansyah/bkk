<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AktivitasUser extends Model
{
    use HasFactory;
    protected $table = 'aktivitas_users';
    protected $primaryKey = 'id_aktivitas_users';
    const CREATED_AT = 'waktu';
    const UPDATED_AT = false;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($Model) {
            $prefix = 'USR';
            $lastRecord = self::orderBy('username', 'desc')->first();

            $lastNumber = $lastRecord ? intval(substr($lastRecord->username, strlen($prefix))) : 0;
            $newNumber = $lastNumber + 1;

            $Model->username = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        });
    }

    public function user () :BelongsTo {
        return $this->belongsTo(User::class, 'username');
    }
}
