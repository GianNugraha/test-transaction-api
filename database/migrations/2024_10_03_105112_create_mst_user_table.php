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

        Schema::create('mst_user', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('username');
            $table->string('password');
            $table->string('api_token');
            $table->dateTime('api_token_expired_at');
            $table->string('detail_type');
            $table->bigInteger('detail_id');
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
        Schema::dropIfExists('mst_user');
    }
};
