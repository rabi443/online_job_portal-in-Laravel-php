<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname')->nullable();
            $table->date('dob');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->string('country');
            $table->string('province');
            $table->string('city');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_seeker');
    }
};
