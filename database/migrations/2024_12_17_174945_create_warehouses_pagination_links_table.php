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
        Schema::create('warehouses_pagination_links', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('label');
            $table->boolean('active');
            $table->unsignedBigInteger('pagination_id');
            $table->timestamps();
            $table->foreign('pagination_id')
                  ->references('id')->on('warehouses_pagination')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses_pagination_links');
    }
};
