<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $table = 'job_title';

    protected $fillable = ['job_title', 'category_id'];

    // Define relationship to JobCategory
    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }
}
