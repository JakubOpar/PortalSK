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
            $table->id();
            $table->string('name', 20);
            $table->string('surname', 25);
            $table->string('email', 40)->unique();
            $table->bigInteger('phone_number')->nullable()->check('phone_number IS NULL OR length(phone_number) = 9');
            $table->string('login', 30)->unique();
            $table->string('password', 100);
            $table->integer('permission')->default(2)->check('permission >= 0');
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
        //Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
