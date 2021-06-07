<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->index();
            $table->date('date');
            $table->string('title');
            $table->string('slug', 355)->unique();
            $table->string('reporter')->nullable();
            $table->tinyInteger('position')->nullable();
            $table->longText('content');
            $table->string('photo');
            $table->string('video')->nullable();
            $table->string('tags')->nullable();
            $table->string('short_content')->nullable();
            $table->integer('view')->default(0);
            $table->BigInteger('post_by');
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
        Schema::dropIfExists('news');
    }
}
