<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitySubsectorTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('activity_subsector', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_activity'); // foreign key to activity table
            $table->unsignedBigInteger('id_subsector'); // foreign key to subsector table
            $table->integer('priority')->default(1); // Tambahkan kolom priority dengan default 1
            $table->timestamps();
            // Add foreign key constraints
            $table->foreign('id_activity')->references('id_activity')->on('activity')->onDelete('cascade');
            $table->foreign('id_subsector')->references('id_subsector')->on('subsector')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_subsector');
    }
}
