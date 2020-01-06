<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiathuetscongctdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giathuetscongctdf', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tents')->nullable();
            $table->string('soluong')->nullable();
            $table->string('dvt')->nullable();
            $table->string('dongiathue')->nullable();
            $table->string('dvthue')->nullable();
            $table->string('hdthue')->nullable();
            $table->string('ththue')->nullable();
            $table->string('sotienthuenam')->nullable();
            $table->string('maxa')->nullable();
            $table->string('mahuyen')->nullable();
            $table->string('district')->nullable();
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
        Schema::dropIfExists('giathuetscongctdf');
    }
}
