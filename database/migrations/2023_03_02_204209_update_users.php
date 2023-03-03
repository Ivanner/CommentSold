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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('super_admin')->default(false);
            $table->boolean('is_enabled')->default(false);
            $table->string('shop_name');
            $table->string('card_brand');
            $table->string('card_last_four', 4);
            $table->dateTime('trial_starts_at');
            $table->dateTime('trial_ends_at');
            $table->string('shop_domain');
            $table->string('billing_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('super_admin');
            $table->dropColumn('is_enabled');
            $table->dropColumn('shop_name');
            $table->dropColumn('card_brand');
            $table->dropColumn('card_last_four');
            $table->dropColumn('trial_starts_at');
            $table->dropColumn('trial_ends_at');
            $table->dropColumn('shop_domain');
            $table->dropColumn('billing_plan');
        });
    }
};
