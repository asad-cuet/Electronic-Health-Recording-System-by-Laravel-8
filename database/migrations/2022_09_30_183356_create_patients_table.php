<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('pre_name');
            $table->string('fname');
            $table->string('lname');
            $table->string('full_name');
            $table->string('gender');
            $table->integer('age');
            $table->text('height');
            $table->integer('weight');
            $table->text('address');
            $table->text('phone');
            $table->integer('health_insurance');
            $table->text('guardian_name');
            $table->text('guardian_phone');
            $table->text('relationship');
            $table->text('history_id')->unique();
            $table->integer('is_consulted')->default(0);
            $table->integer('is_cleared')->default(0);
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
        Schema::dropIfExists('patients');
    }
}
