<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

     // public $timestamps = false;  //if enable this then auto created_at and updated_at will not work which is default in laravel

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = ['id','role', 'password','otp', 'email', 'contact_number', 'active_status', 'account_status', 'email_status', 'contact_status'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



        // Relationship with Job Seeker Details
        public function jobSeeker()
        {
            return $this->hasOne(JobSeeker::class);
        }
    
        // Relationship with Employer
        public function employer()
        {
            return $this->hasOne(Employer::class);
        }
    

        public function education()
        {
            return $this->hasOne(Education::class);
        }

       // Relationship with Resume
        public function resume() 
        {
            return $this->hasOne(Resume::class, 'user_id');
        }


        public function profilePicture()
        {
            return $this->hasOne(ProfilePicture::class);
        }

        
}
