<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'company_name', 'country', 'province', 'city', 'organization_type', 'website', 'about_company'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Jobs
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'employer_id');
    }

}
