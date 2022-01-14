<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $primaryKey = 'tag_key';

    public $increment = false;

    protected $fillable = ['tag_key'];
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
