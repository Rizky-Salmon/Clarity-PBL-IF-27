<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsectorTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('subsector', function (Blueprint $table) {
            $table->bigIncrements('id_subsector');
            $table->string('subsector_name', 255);
            $table->text('description'); // Mengubah tipe kolom description menjadi text
            $table->unsignedBigInteger('id_sector');
            $table->foreign('id_sector')->references('id_sector')->on('sector');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subsector');
    }
};
