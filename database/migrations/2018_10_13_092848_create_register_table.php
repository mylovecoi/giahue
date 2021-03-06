<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maxa',30)->nullable();
            $table->string('mahuyen')->nullable();
            $table->string('tendn')->nullable();
            $table->string('diachi')->nullable();
            $table->string('tel')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('diadanh')->nullable();
            $table->string('chucdanh')->nullable();
            $table->string('nguoiky')->nullable();
            $table->string('noidknopthue')->nullable();
            $table->string('ghichu')->nullable();
            $table->string('tailieu')->nullable();
            $table->string('giayphepkd')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('level')->nullable();
            $table->string('trangthai')->nullable();
            $table->text('lydo')->nullable();
            $table->string('ma')->nullable();
            $table->string('pl')->nullable();

            $table->text('settingdvvt')->nullable();
            $table->double('vtxk')->default(0);
            $table->double('vtxb')->default(0);
            $table->double('vtxtx')->default(0);
            $table->double('vtch')->default(0);

            $table->string('loaihinhhd')->nullable();
            $table->double('xangdau')->default(0);
            $table->double('dien')->default(0);
            $table->double('khidau')->default(0);
            $table->double('phan')->default(0);
            $table->double('thuocbvtv')->default(0);
            $table->double('vacxingsgc')->default(0);
            $table->double('muoi')->default(0);
            $table->double('suate6t')->default(0);
            $table->double('duong')->default(0);
            $table->double('thocgao')->default(0);
            $table->double('thuocpcb')->default(0);
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
        Schema::dropIfExists('register');
    }
}
