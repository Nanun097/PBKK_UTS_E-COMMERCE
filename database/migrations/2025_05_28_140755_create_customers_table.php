<?php

// Migration 1: create_customers_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->ulid('customer_id')->primary();
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('password', 50);
            $table->date('phone');
            $table->date('address');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};