<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('name')->nullable();
            $table->text('title')->nullable();
            $table->integer('display')->default(config('custom.display.on'));
            $table->integer('sequence')->default(1);
            $table->integer('edit_mode')->default(0);
            $table->boolean('required')->default(true);
            $table->integer('format');
            $table->text('select1')->nullable();
            $table->text('select2')->nullable();
            $table->text('select3')->nullable();
            $table->text('select4')->nullable();
            $table->text('select5')->nullable();
            $table->text('option')->nullable();
            $table->integer('max')->nullable();
            $table->integer('min')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
