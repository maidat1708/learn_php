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
            $table->string('name')->nullable(true)->comment("User's name");
            $table->date("dob")->nullable(true)->comment("Day of birth");
            $table->string("numberPhone")->nullable(true)->comment("User's number phone");
            $table->string("address")->nullable(true)->comment("User's address");
            $table->unsignedBigInteger("user_id")->comment("Foreign key user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
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
