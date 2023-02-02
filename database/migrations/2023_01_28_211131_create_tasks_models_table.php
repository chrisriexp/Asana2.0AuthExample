<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_models', function (Blueprint $table) {
            $table->id();
            $table->string('appID');
            $table->string('carrier');
            $table->string('desc');
            $table->boolean('api');
            $table->string('notes')->nullable();
            $table->date('date-completed')->nullable();
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('tasks_models');
    }
};
