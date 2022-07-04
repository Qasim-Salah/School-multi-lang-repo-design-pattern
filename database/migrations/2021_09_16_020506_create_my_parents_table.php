<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->string('name_father');
            $table->char('phone_father', 10)->unique();
            $table->string('job_father');
            $table->integer('blood_type_father_id')->unsigned();
            $table->string('address_father');

            //Mother information
            $table->string('name_mother');
            $table->char('phone_mother', 10)->unique();
            $table->string('job_mother');
            $table->integer('blood_type_mother_id')->unsigned();
            $table->string('address_mother');
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
        Schema::dropIfExists('my_parents');
    }
}
