<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('description',200)->nullable();
            $table->decimal('price',20)->check('price >= 0');
            $table->boolean('negotiation');
            $table->string('type',25);
            $table->date('publication_date')->check('publication_date >= 2024-01-01');
            $table->string('status',25);
            $table->string('tags',100)->nullable();
            $table->foreignIdFor(User::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
