<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();

            $table->integer('patient_id'); //from Patient
            $table->integer('consulted_by')->comment('Doctor Id'); 
            $table->integer('department_id'); 

            $table->longText('problem_details')->nullable();  
            $table->text('problem_duration')->nullable();  
            
            $table->integer('is_examed')->nullable()->default(0); // 1 or 0
            $table->integer('is_on_exam')->nullable()->default(0); // 1 or 0


            $table->longText('exam_result')->nullable(); 

            $table->integer('is_complete')->nullable()->default(0); // 1 or 0

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
        Schema::dropIfExists('consultations');
    }
}
