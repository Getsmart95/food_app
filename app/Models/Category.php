<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_key';
    public $incrementing = false;
    protected $fillable = [
        'category_key'
    ];

    /**
     * Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translation() {
        return $this->belongsTo(Translate::class,'category_key', 'key');
    }
    
}
