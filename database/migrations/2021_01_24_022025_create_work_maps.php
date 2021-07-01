<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkMaps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_maps', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('map_id');
            $table->string('total_map');
            $table->string('total_key');
            $table->date('start_on');
            $table->string('progress')->nullable();
            $table->date('finish_on')->nullable();
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
        Schema::dropIfExists('work_maps');
    }
}
