<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 使わないテーブルをDrop
        Schema::table('password_resets', function (Blueprint $table) {
            Schema::dropIfExists('password_resets');
        });

        Schema::table('failed_jobs', function (Blueprint $table) {
            Schema::dropIfExists('failed_jobs');
        });

        Schema::table('personal_access_tokens', function (Blueprint $table) {
            Schema::dropIfExists('personal_access_tokens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
