<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get the translation te Diet
     *
     * @return \Illuminate\Translatebase\Eloqunamens\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo(Translate::class, 'name', 'id');
    }
}
