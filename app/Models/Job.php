<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Skill;

class Job extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false; // 👈 Tell Laravel that id is manually inserted
    protected $keyType = 'integer'; // 👈 Since you are using integer (not UUID)

    protected $fillable = ['id','employer_id', 'category_id', 'title_id', 'skills', 'experience', 'job_type', 'number_of_vacancies', 'salary_basis', 'offered_salary', 'salary', 'min_salary', 'max_salary', 'industry', 'functional_area', 'job_description', 'what_we_offer', 'status', 'posted_date', 'expire_date', 'updated_date'];

    // Relationship with Employer (Company)
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

    // Relationship with Job Applications
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }


    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }


    public function getSkillListAttribute()
    {
        if (!$this->skills) return collect();

        $ids = array_filter(explode(',', $this->skills));
        return Skill::whereIn('id', $ids)->get();
    }

    // In Job.php
    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class, 'title_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'job_id');
    }


}
