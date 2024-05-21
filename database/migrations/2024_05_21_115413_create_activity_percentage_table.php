<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityPercentageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_percentage', function (Blueprint $table) {
            $table->bigIncrements('id_activity_percentage'); // primary key
            $table->unsignedBigInteger('id_activity'); // foreign key to activity table
            $table->unsignedBigInteger('id_employees'); // foreign key to employees table
            $table->integer('percentage'); // percentage field
            $table->timestamps(); // created_at and updated_at

            // Add foreign key constraints
            $table->foreign('id_activity')->references('id_activity')->on('activity')->onDelete('cascade');
            $table->foreign('id_employees')->references('id_employees')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_percentage');
    }
}
