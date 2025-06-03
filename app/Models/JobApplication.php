<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
        use HasFactory;

    protected $fillable = [
        'jobseeker_id',
        'job_id',
        'status',
    ];
    
    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
