<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_billings', function (Blueprint $table) {
            $table->dropColumn(['city', 'address', 'address2', 'zip']);
            $table->after('taxnum', function ($table) {
                $table->string('choose_company');
                $table->foreignId('address_id')->nullable()->constrained('addresses');
            });
        });

        Schema::table('order_shippings', function (Blueprint $table) {
            $table->dropColumn(['city', 'address', 'address2', 'zip']);
            $table->after('name', function ($table) {
                $table->foreignId('address_id')->nullable()->constrained('addresses');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
