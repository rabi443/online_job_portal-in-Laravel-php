<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    protected $fillable = [
        'user_id',
        'file_path',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
