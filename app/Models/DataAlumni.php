<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataAlumni extends Model
{
    use HasFactory;

    protected $table = 'data_alumni';
    protected $primaryKey = 'nik';
    protected $keyType = 'string';
    protected $incrementing = false;
    public $timestamps = false;
    protected $guard = [];

    public function user () :BelongsTo {
        return $this->belongsTo(User::class, 'username');
    }
}
