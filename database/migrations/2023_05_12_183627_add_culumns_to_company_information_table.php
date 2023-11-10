<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCulumnsToCompanyInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_information', function (Blueprint $table) {
            //追加
            $table->text('station_1')->after('closed')->nullable();
            $table->text('station_2')->after('station_1')->nullable();
            $table->text('parking')->after('station_2')->nullable();
            $table->text('line')->after('parking')->nullable();
            $table->text('twitter')->after('line')->nullable();
            $table->text('instagram')->after('twitter')->nullable();
            $table->text('president')->after('instagram')->nullable();
            $table->text('established')->after('president')->nullable();
            $table->text('capital')->after('established')->nullable();
            $table->text('business')->after('capital')->nullable();
            $table->text('employees')->after('business')->nullable();
            $table->text('client')->after('employees')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_information', function (Blueprint $table) {
            //追加
            $table->dropColumn('station_1');
            $table->dropColumn('station_2');
            $table->dropColumn('parking');
            $table->dropColumn('line');
            $table->dropColumn('twitter');
            $table->dropColumn('instagram');
            $table->dropColumn('president');
            $table->dropColumn('established');
            $table->dropColumn('capital');
            $table->dropColumn('business');
            $table->dropColumn('employees');
            $table->dropColumn('client');
        });
    }
}
