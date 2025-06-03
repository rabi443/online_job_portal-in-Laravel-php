<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}