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
        Schema::create('employers', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('country');
            $table->string('province');
            $table->string('city');
            $table->string('organization_type')->nullable();
            $table->string('website')->nullable();
            $table->text('about_company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer');
    }
};
