<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSgLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sg_log', function (Blueprint $table) {
            $table->increments('id');

            $table->string('level');
            $table->text('message');
            $table->text('request_full_url');
            $table->text('request_url');
            $table->text('request_uri');
            $table->string('request_method');
            $table->string('devices')->nullable();
            $table->string('os')->nullable();
            $table->string('os_version')->nullable();
            $table->string('browser_name')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('browser_accept_language')->nullable();
            //$table->string('desktop')->nullable();
            //$table->string('phone')->nullable();
            $table->string('robot')->nullable();
            $table->string('client_ip')->nullable();
            $table->integer('user_id')->unsigned();
            /*
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');*/

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
        Schema::dropIfExists('sg_log');
    }
}
