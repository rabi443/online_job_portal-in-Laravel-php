<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_balance',
        'employer_id',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    
}

