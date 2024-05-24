<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;
    public $timestamps = false;
    //generator losowych ciągów znaków dla nazw obrazka
    protected $fillable = ['file', 'description', 'offer_id'];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
