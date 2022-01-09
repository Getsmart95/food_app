<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $primaryKey = 'recipe_key';
    public $incrementing = false;
    protected $fillable = [
        'cooking_time',
        'views',
        'likes',
        'dislikes',
        'is_active',
        'difficulty_id',
        'recipe_key',
        'category_key',
        'cuisine_key',
        'energy_key',
        'tips',
        'description',
        'photos'
    ];
}
