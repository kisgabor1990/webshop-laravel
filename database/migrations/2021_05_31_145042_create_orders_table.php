<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->integer('phone')->unsigned();
            $table->timestamp('accepted')->useCurrent();
            $table->timestamps();
        });

        Schema::create('order_billings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('taxnum')->nullable();
            $table->string('city');
            $table->string('address');
            $table->string('address2');
            $table->integer('zip')->unsigned();
            $table->timestamps();
        });

        Schema::create('order_shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('address');
            $table->string('address2');
            $table->integer('zip')->unsigned();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('billing_id')->nullable()->constrained('order_billings');
            $table->foreignId('shipping_id')->nullable()->constrained('order_shippings');
            $table->text('payment');
            $table->text('shipping_mode');
            $table->integer('shipping_price')->unsigned();
            $table->integer('amount')->unsigned();
            $table->boolean('isPaid')->default('0');
            $table->string('status');
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
            $table->string('product_name');
            $table->integer('quantity')->unsigned();
            $table->integer('price')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('order_billings');
        Schema::dropIfExists('order_shippings');
        Schema::dropIfExists('shippings');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_product');
    }
}
