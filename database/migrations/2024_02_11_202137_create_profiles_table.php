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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type' , ['individual' , 'company'])->default('company');
            $table->string('name');
            $table->string('number')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('stats')->nullable();
            $table->string('logo')->nullable();
            $table->string('organisations_nr')->nullable();
            $table->string('note')->nullable();
            $table->string('subscribe_code')->nullable();
            $table->string('packege')->nullable();
            $table->string('website')->nullable();
            $table->enum('status', ['active' , 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};