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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->enum('role', ['employer', 'jobseeker']);
            $table->string('password');
            $table->string('otp', 6)->nullable();
            $table->string('email')->unique();
            $table->enum('email_status', ['verified', 'not verified'])->default('not verified');
            $table->string('contact_number', 10)->unique();
            $table->enum('contact_status', ['verified', 'not verified'])->default('not verified');
            $table->rememberToken();
            $table->enum('active_status', ['online', 'offline'])->default('offline');
            $table->enum('account_status', ['verified', 'not verified'])->default('not verified');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('otp_verifications');

    }
};
