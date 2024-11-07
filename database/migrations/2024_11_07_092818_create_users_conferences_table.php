<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersConferencesTable extends Migration
{

    public function up(): void
    {
        Schema::create('users_conferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // References the users table
            $table->foreignId('conference_id')->constrained()->onDelete('cascade'); // References the conferences table
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users_conferences');
    }
}
