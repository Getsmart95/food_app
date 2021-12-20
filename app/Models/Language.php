<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_code'
    ];

    /**
     * Get the user that owns the Language
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function translation()
    // {
    //     return $this->belongsTo(Translate::class, 'code', 'language_code');
    // }

    /**
     * Get all of the comments for the Language
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translation()
    {
        return $this->belongsTo(Translate::class, 'iso_code', 'language_id');
    }
}
