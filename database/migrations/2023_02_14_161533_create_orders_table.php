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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('customer_name', 75);
            $table->string('customer_surname', 75);
            $table->string('customer_address');
            $table->string('customer_mail', 150); //check
            $table->string('customer_phone_number', 50); //check
            $table->string('customer_note');
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
        Schema::dropIfExists('orders');
    }
};
