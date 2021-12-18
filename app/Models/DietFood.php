<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietFood extends Model
{
    use HasFactory;
    protected $table = 'diets_foods';
    protected $fillable = [
        'diet_id',
        'diet_food'
    ];

    /**
     * Get the translation te Diet
     *
     * @return \Illuminate\Translatebase\Eloqunamens\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo(Translate::class, 'diet_food', 'id');
    }
}
