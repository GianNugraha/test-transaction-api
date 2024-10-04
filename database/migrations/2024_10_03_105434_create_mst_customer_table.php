<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mst_customer', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('registration_number');
            $table->string('fullname');
            $table->string('address');
            $table->string('phone_number');
            $table->dateTime('registration_date');
            $table->integer('customer_point');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_customer');
    }
};
