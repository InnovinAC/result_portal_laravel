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
        Schema::create('result_extras', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('school_class_id');
            $table->integer('term_id');
            $table->integer('session_id');
            $table->string('comment');
            $table->string('resumption_date');


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
        Schema::dropIfExists('result_extras');
    }
};
