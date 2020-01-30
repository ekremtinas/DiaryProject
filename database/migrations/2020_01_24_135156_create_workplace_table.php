<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workplace', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('workplaceName');
            $table->date('defaultDate')->nullable();
            $table->time('minTime')->nullable();
            $table->time('maxTime')->nullable();
            $table->boolean('weekends')->nullable();
            $table->string('defaultView');
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
        Schema::dropIfExists('workplace');
    }
}
