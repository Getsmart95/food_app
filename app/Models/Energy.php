<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Energy extends Model
{
    use HasFactory;
    protected $primaryKey = 'energy_key';
    public $incrementing = false;
    protected $fillable = [
        'energy_key',
        'calories',
        'fats',
        'carbohydrates',
        'proteins'
    ];


}
