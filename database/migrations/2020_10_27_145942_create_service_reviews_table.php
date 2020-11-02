<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('parent_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('review')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->boolean('high_priority')->default(0);
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
        Schema::dropIfExists('service_reviews');
    }
}
