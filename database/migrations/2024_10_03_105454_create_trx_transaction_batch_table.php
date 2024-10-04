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
        Schema::create('trx_transaction_batch', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('transaction_number');
            $table->bigInteger('customer_id');
            $table->dateTime('transaction_time');
            $table->bigInteger('employee_id');
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
        Schema::dropIfExists('trx_transaction_batch');
    }
};
