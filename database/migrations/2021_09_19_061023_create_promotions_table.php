<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('from_grade');
            $table->integer('from_classroom');
            $table->integer('from_section');
            $table->integer('to_grade');
            $table->integer('to_classroom');
            $table->integer('to_section');
            $table->string('academic_year');
            $table->string('academic_year_new');
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
        Schema::dropIfExists('promotions');
    }
}
