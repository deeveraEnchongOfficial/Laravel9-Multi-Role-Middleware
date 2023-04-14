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
        Schema::create('booking_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')
                    ->references('id')
                    ->on('shops')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('vehicle_lists_id');
            $table->foreign('vehicle_lists_id')
                            ->references('id')
                            ->on('vehicle_lists')
                            ->onDelete('cascade');   
            $table->string('client_name');
            $table->string('email');  
            $table->string('address');
            $table->string('schedule_date'); 
            $table->string('total_amount'); 
            $table->string('status')->default(1); 
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
        Schema::dropIfExists('booking_lists');
    }
};
