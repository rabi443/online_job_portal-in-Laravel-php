<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobSeeker extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'fname', 'lname', 'mname', 'dob', 'gender', 'marital_status', 'country', 'province', 'city'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_seeker_id');
    }


   
}
