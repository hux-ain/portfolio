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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('category', ['backend', 'frontend', 'devops', 'tools', 'other'])->default('other');
            $table->string('icon_class', 100)->nullable(); // FontAwesome icon class
            $table->integer('proficiency_level')->default(80); // 0-100%
            $table->integer('order_number')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
