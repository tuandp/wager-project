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
        Schema::create('wagers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('total_wager_value')->default(0);
            $table->unsignedInteger('odds')->default(0);
            $table->unsignedInteger('amount_sold')->nullable();
            $table->decimal('selling_price')->default(0);
            $table->unsignedInteger('selling_percentage')->default(0);
            $table->unsignedInteger('percentage_sold')->default(0);
            $table->decimal('current_selling_price')->default(0);
            $table->dateTime('placed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wagers');
    }
};
