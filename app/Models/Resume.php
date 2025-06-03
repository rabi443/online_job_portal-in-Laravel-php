<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'phone',
        'location',
        'linkedin',
        'summary',
        'experience',
        'education',
        'skills',
        'resume',
        'profile_pic',
    ];

    protected $casts = [
        'experience' => 'array',
        'education' => 'array',
        'skills' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
