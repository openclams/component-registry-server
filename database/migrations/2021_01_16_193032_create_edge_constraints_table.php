<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdgeConstraintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edge_constraints', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('edge_id')
                        ->constrained()
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
            $table->foreignId('from_component_id')
                        ->references('id')
                        ->on('components')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
            $table->foreignId('to_component_id')
                        ->references('id')
                        ->on('components')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edge_constraints');
    }
}
