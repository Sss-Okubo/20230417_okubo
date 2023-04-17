<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storeReviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id')->default(0);
            $table->integer('stars')->default(0);
            $table->text('comment');
            $table->timestamp('created_at')->useCurrent()->nullable;
            $table->timestamp('updated_at')->useCurrent()->nullable;

            $table->foreign('reservation_id')->references('id')->on('reservations');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storeReviews');
    }
}
