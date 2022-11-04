<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->integer('consultation_id');
            $table->integer('test_id');
            $table->text('report')->nullable();
            $table->text('comment_from_lab')->nullable();
            $table->text('comment_from_doctor')->nullable();
            $table->integer('is_resent')->default(0);
            $table->integer('is_once_sent_to_consult')->default(0);
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
        Schema::dropIfExists('exams');
    }
}
