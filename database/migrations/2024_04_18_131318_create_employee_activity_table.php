<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeActivityTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('employee_activity', function (Blueprint $table) {
            $table->unsignedBigInteger('id_activity');
            $table->foreign('id_activity')->references('id_activity')->on('activity');

            $table->unsignedBigInteger('id_employees');
            $table->foreign('id_employees')->references('id_employees')->on('employees');

            $table->unsignedBigInteger('id_subsector');
            $table->foreign('id_subsector')->references('id_subsector')->on('subsector');

            $table->integer('persentase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_activity');
    }
};
