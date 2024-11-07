<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the 'name' and 'password' columns if they don't exist
            $table->string('name')->nullable()->after('email'); // Make it nullable if it's optional
            $table->string('password')->nullable()->after('name'); // Add password column
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback the changes (drop the columns if necessary)
            $table->dropColumn(['name', 'password']);
        });
    }
};
