<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    protected $table = 'job_category';

    protected $fillable = ['name'];

    // Define relationship to JobTitle
    public function jobTitles()
    {
        return $this->hasMany(JobTitle::class, 'category_id');
    }

   // App\Models\JobCategory.php
    public function jobs()
    {
        return $this->hasMany(Job::class, 'category_id'); // Adjust 'category_id' if it's named differently
    }


}

