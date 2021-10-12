<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_bills', function (Blueprint $table) {
            $table->id();
            $table->string('item_barcode');
            $table->string('item_name');
            $table->string('group_name');
            $table->string('unit_name');
            $table->string('dropping_place'); // مكان الاستلام
            $table->string('buying_type');
            $table->unsignedInteger('amount');
            $table->decimal('group_price', 8, 2, true)->default(0.0); // سعر الجملة
            $table->decimal('individual_price', 8, 2, true)->default(0.0); // سعر الشراء
            $table->decimal('payed', 8, 2, true)->default(0.0)->nullable();
            $table->decimal('money', 8, 2, true)->default(0.0);
            $table->unsignedInteger('item_quantity_on_show');
            $table->unsignedInteger('item_quantity_in_stock');
            $table->foreignId('vendor_id')
                ->references('id')
                ->on('vendors')
                ->onUpdate('cascade');
            $table->string('payment_method');
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
        Schema::dropIfExists('buy_bills');
    }
}
