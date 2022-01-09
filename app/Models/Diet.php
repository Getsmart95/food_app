<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;
    protected $primaryKey = 'diet_key';
    public $incrementing = false;
    protected $fillable = [
        'diet_key'
    ];

    /**
     * Get the translation te Diet
     *
     * @return \Illuminate\Translatebase\Eloqunamens\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo(Translate::class, 'diet_key', 'key');
    }
}
