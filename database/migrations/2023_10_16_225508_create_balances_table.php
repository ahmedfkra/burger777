<?php

use App\Models\User;
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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->string('work_shift');
            //$table->unsignedBigInteger('user_id');
            //$table->foreign('user_id')->references('id')->on('users');
            $table->string('branch_name');
            $table->string('cashir_name');
            $table->time('start_date');
            $table->time('end_date');
            $table->float('cash_500');
            $table->float('cash_200');
            $table->float('cash_100');
            $table->float('cash_50');
            //$table->float('cash_20');
            $table->float('cash_10');
            $table->float('cash_1');
            $table->float('net');
            $table->float('other');
            $table->float('total_cash')->nullable();
            $table->float('total_network')->nullable();
            $table->float('total_amount')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }

};
