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
        Schema::create('bhavcopies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('symbol_id');

            // Ensure the foreign key constraint is valid
            $table->foreign('symbol_id')->references('id')->on('symbols')->onDelete('cascade');

            $table->string('series');
            $table->date('date1')->default('1970-01-01');
            $table->decimal('prev_close', 10, 2)->default(0.00);
            $table->decimal('open_price', 10, 2)->default(0.00);
            $table->decimal('high_price', 10, 2)->default(0.00);
            $table->decimal('low_price', 10, 2)->default(0.00);
            $table->decimal('last_price', 10, 2)->default(0.00);
            $table->decimal('close_price', 10, 2)->default(0.00);
            $table->decimal('avg_price', 10, 2)->default(0.00);
            $table->unsignedBigInteger('ttl_trd_qnty')->default(0);
            $table->decimal('turnover_lacs', 10, 2)->default(0.00);
            $table->unsignedBigInteger('no_of_trades')->default(0);
            $table->unsignedBigInteger('deliv_qty')->default(0);
            $table->decimal('deliv_per', 5, 2)->default(0.00); // Adjusted scale for deliv_per

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bhavcopies');
    }
};
