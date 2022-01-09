<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $primaryKey = 'status_key';
    protected $fillable =[
        'status_key',
        'point_min',
        'point_max'
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
