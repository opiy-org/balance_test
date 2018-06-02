<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('from_user_id')->nullable();
            $table->foreign('from_user_id')
                ->references('id')->on('users')
                ->onDelete('SET NULL');

            $table->unsignedInteger('to_user_id')->nullable();
            $table->foreign('to_user_id')
                ->references('id')->on('users')
                ->onDelete('SET NULL');


            $table->unsignedDecimal('amount', 12, 2);

            $table->unsignedSmallInteger('status')->default('0');
            $table->text('error_msg')->nullable();

            $table->timestamps();

            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
