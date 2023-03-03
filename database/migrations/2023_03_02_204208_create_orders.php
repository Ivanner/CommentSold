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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('inventory_id')->constrained();
            $table->text('street_address');
            $table->text('apartment')->nullable();
            $table->text('city');
            $table->text('state');
            $table->string('country_code', 2);
            $table->text('zip')->nullable();
            $table->string('phone_number');
            $table->text('email');
            $table->string('name');
            $table->string('order_status');
            $table->text('payment_ref')->nullable();
            $table->string('transaction_id')->nullable();
            $table->integer('payment_amt_cents')->default(0);
            $table->integer('ship_charged_cents')->default(0);
            $table->integer('ship_cost_cents')->default(0);
            $table->integer('subtotal_cents')->default(0);
            $table->integer('total_cents')->default(0);
            $table->text('shipper_name');
            $table->dateTime('payment_date');
            $table->dateTime('shipped_date');
            $table->text('tracking_number');
            $table->integer('tax_total_cents')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
