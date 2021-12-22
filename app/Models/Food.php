<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'food_key',
        'food_category_key'
    ];

    /**
     * Get the translation that owns the food
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo(Translate::class, 'food_key', 'key');
    }
    /**
     * Get the user that owns the food
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function food_category()
    {
        return $this->belongsTo(Translate::class, 'food_category_key', 'key');
    }

    public function food()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_key', 'id');
    }

    public function diet_foods()
    {
        return $this->belongsTo(DietFood::class, 'name', 'diet_food');
    }
}
