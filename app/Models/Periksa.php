<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Periksa extends Model
{
    protected $table = 'periksas';
    protected $fillable = [
        'id_janji_periksa',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    public function janjiPeriksa(): BelongsTo
    {
        return $this->belongsTo(JanjiPeriksa::class, 'id_janji_periksa');
    }
}