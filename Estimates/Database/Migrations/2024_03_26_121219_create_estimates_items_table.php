<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('estimate_id');
            $table->string('unit_id');
            $table->decimal('unit_value', 12, 3);
            $table->decimal('work_quantity', 12, 3)->nullable();
            $table->decimal('work_cost', 12, 3)->nullable();
            $table->decimal('resource_cost', 12, 3)->nullable();
            $table->decimal('mechanical_cost', 12, 3)->nullable();
            $table->decimal('other_cost', 12, 3)->nullable();
            $table->decimal('total_cost', 12, 3)->nullable();
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
        Schema::dropIfExists('estimate_items');
    }
}
