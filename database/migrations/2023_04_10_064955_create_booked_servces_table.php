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
        Schema::create('booked_servces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_lists_id');
            $table->foreign('booking_lists_id')
                    ->references('id')
                    ->on('booking_lists')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('services_id');
            $table->foreign('services_id')
                    ->references('id')
                    ->on('services')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('vehicle_lists_id');
            $table->foreign('vehicle_lists_id')
                            ->references('id')
                            ->on('vehicle_lists')
                            ->onDelete('cascade');
            $table->string('service_name');
            $table->string('service_amount');
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
        Schema::dropIfExists('booked_servces');
    }
};
