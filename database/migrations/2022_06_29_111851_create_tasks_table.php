<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('custom_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('status')->nullable();
            $table->dateTime('time_estimation')->nullable();
            $table->string('priority')->nullable();
            $table->string('reporter')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')
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
        Schema::dropIfExists('tasks');
    }
}
