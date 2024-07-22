<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lamaran extends Model
{
    use HasFactory;
    protected $table = 'lamaran';
    protected $fillable = ['id_loker', 'id_alumni', 'file'];

    public function loker () : BelongsTo {
        return $this->belongsTo(Loker::class);
    }

    public function alumni () : BelongsTo {
        return $this->belongsTo(Alumni::class);
    }
}
