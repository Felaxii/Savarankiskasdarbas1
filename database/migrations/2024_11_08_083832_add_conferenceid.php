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
        Schema::table('user', function (Blueprint $table) {
            $table->unsignedBigInteger('conference_id')->nullable(); // Use unsignedBigInteger for foreign key
            // Optionally, if you want to set a foreign key constraint
            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropForeign(['conference_id']); // Remove foreign key
            $table->dropColumn('conference_id'); // Drop the column
        });
    }
    
};
