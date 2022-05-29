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
        Schema::create('wager_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wager_id');

            $table->foreign('wager_id')
                ->references('id')
                ->on('wagers')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->decimal('buying_price')->default(0);
            $table->dateTime('bought_at');

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('wager_purchases');
        Schema::enableForeignKeyConstraints();
    }
};
