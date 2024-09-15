<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aktivitas extends Model
{
    use HasFactory;
    protected $table = 'aktivitas_users';
    protected $primaryKey = 'id_aktivitas_users';
    const CREATED_AT = 'waktu';
    const UPDATED_AT = null;
    protected $guarded = [];

    public function user () :BelongsTo {
        return $this->belongsTo(User::class, 'username');
    }
}
