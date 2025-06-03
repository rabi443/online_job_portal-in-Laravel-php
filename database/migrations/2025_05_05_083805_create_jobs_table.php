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
        Schema::create('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Manually set id as primary without auto-increment
            $table->foreignId('employer_id')->constrained('employers')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('job_category')->onDelete('cascade');
            $table->foreignId('title_id')->constrained('job_title')->onDelete('cascade');
            $table->text('skills')->nullable();
            $table->text('experience')->nullable();
            $table->enum('job_type', ['Full-Time', 'Part-Time', 'Contract']);
            $table->integer('number_of_vacancies');
            $table->enum('salary_basis', ['monthly', 'yearly', 'contract']);
            $table->enum('offered_salary', ['fixed', 'range', 'negotiable']);
            $table->decimal('salary', 10, 2)->nullable();
            $table->decimal('min_salary', 10, 2)->nullable();
            $table->decimal('max_salary', 10, 2)->nullable();
            $table->string('industry')->nullable();
            $table->string('functional_area')->nullable();
            $table->text('job_description')->nullable();
            $table->text('what_we_offer')->nullable();
            $table->enum('status', ['pending', 'expired', 'active'])->default('pending');

              // Custom date columns
            $table->timestamp('posted_date')->nullable();
            $table->timestamp('expire_date')->nullable();
            $table->timestamp('updated_date')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
