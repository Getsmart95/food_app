<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietFood extends Model
{
    use HasFactory;
    protected $table = 'diets_foods';

    protected $fillable = [
        'diet_key',
        'food_key'
    ];

    /**
     * Get the translation te Diet
     *
     * @return \Illuminate\Translatebase\Eloqunamens\BelongsTo
     */
    public function food()
    {
        return $this->belongsTo(Translate::class, 'food_key', 'key');
    }

        /**
     * Get the translation te Diet
     *
     * @return \Illuminate\Translatebase\Eloqunamens\BelongsTo
     */
    public function diet()
    {
        return $this->belongsTo(Translate::class, 'diet_key', 'key');
    }

    public function diet_foods()
    {
        return $this->belongsTo(DietFood::class, 'diet_key', 'diet_key');
    }
}
