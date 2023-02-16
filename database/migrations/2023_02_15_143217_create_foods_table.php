<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('slug', 210);
            $table->tinyInteger('is_available')->default(1);
            $table->decimal('price', 5, 2);
            $table->string('description')->nullable();
            $table->string('img_url', 500)->nullable();
            $table->string('img_url_original_name')->nullable();
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
        Schema::dropIfExists('foods');
    }
};
