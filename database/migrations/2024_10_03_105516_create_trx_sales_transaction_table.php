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
        Schema::create('trx_sales_transaction', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('transaction_batch_id');
            $table->bigInteger('item_id');
            $table->integer('item_price');
            $table->integer('total_gross_price');
            $table->integer('discount');
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
        Schema::dropIfExists('trx_sales_transaction');
    }
};
