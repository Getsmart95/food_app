<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'country_key';
    public $incrementing = false;
    protected $fillable = [
        'country_key',
        'code',
        'image_path'
    ];

    /**
     * Get the user that owns the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo(Translate::class, 'country_key', 'key');
    }
}
