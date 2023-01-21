<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Firms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('user_id');
            $table->integer('inn');
            $table->text('about');
            $table->string('general_director', 100);
            $table->string('address');
            $table->string('phone', 20);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firms');
    }
}
