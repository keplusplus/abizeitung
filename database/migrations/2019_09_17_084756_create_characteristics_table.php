<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->string('birthdate');
            $table->string('residence');
            $table->string('adv_courses');
            $table->string('right_advs');
            $table->string('best_topics');
            $table->string('worst_topics');
            $table->string('best_friends')->nullable();
            $table->string('best_moment')->nullable();
            $table->string('worst_moment')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->string('way_of_learning');
            $table->longText('thanks');
            $table->string('most_important');
            $table->string('after_a_levels');
            $table->string('taken_from_school');
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
        Schema::dropIfExists('characteristics');
    }
}
