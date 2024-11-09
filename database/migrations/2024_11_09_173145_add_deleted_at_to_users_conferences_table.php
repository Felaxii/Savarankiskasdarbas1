<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToUsersConferencesTable extends Migration
{
    public function up()
    {
        Schema::table('users_conferences', function (Blueprint $table) {
            $table->softDeletes(); // Adds 'deleted_at' column
        });
    }

    public function down()
    {
        Schema::table('users_conferences', function (Blueprint $table) {
            $table->dropColumn('deleted_at'); // Removes the 'deleted_at' column
        });
    }
}
