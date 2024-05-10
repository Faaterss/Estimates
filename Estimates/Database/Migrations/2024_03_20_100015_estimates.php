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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('client_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('status');
            $table->integer('position_count');
            $table->decimal('in_total');
            $table->decimal('tax');
            $table->decimal('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
