<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->string('primary_admitting_diagnosis')->nullable();
            $table->string('permanant_history')->nullable();
            $table->string('previous_medical_history')->nullable();
            $table->string('surgical_history')->nullable();

            $table->integer('smoker')->nullable();
            $table->integer('diabetes')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('bp_systole')->nullable();
            $table->string('bp_diastole')->nullable();
            $table->string('oxygen_seturation')->nullable();
            $table->integer('pain_on_scale')->nullable();
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
        Schema::dropIfExists('clinical_histories');
    }
}
