<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Opname extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'real_stock',
        'diff_stock',
        'doing_at'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
