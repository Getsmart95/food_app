<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;
    protected $primaryKey = 'reason_key';
    public $incrementing = false;
    protected $fillable = [
        'reason_key',
        'description',
        'value'
    ];

        /**
     * Get the user that owns the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translation()
    {
        return $this->belongsTo(Translate::class, 'reason_key', 'key');
    }
}
