<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Book extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('book_name');
			$table->string('author_name')->nullable();
			$table->string('rating')->default('No ratings yet');
			$table->string('category')->nullable();
			$table->string('year')->nullable();
			$table->string('img_link')->nullable();
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
        Schema::dropIfExists('books');
    }
}
