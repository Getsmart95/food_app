<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;
    protected $primaryKey = 'cuisine_key';
    public $incrementing = false;
    protected $fillable = [
        'cuisine_key'
    ];

    /**
     * Get the translation that owns the Cuisine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo(Translate::class, 'cuisine_key', 'key');
    }
}
