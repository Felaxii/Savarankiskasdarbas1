<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('conferences', function (Blueprint $table) {
            $table->softDeletes(); // This adds the `deleted_at` column for soft deletes
        });
    }
    
    public function down()
    {
        Schema::table('conferences', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Removes the `deleted_at` column if you rollback
        });
    }
};