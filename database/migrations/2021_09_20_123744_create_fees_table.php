<?php

use App\Enums\FeeType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('amount', 8, 2);
            $table->integer('grade_id');
            $table->integer('classroom_id');
            $table->string('description')->nullable();
            $table->string('year');
            $table->enum('type', [FeeType::Bus->value, FeeType::Tuition->value]);
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
        Schema::dropIfExists('fees');
    }
}
