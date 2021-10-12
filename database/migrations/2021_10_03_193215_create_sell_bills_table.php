<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_bills', function (Blueprint $table) {
            $table->id();
            $table->string('item_barcode');
            $table->string('item_name');
            $table->string('item_unit');
            $table->string('item_group');
            $table->unsignedInteger('item_quantity_on_show');
            $table->unsignedInteger('item_quantity_in_stock');
            $table->foreignId('customer_id')
                ->nullable()
                ->default(null)
                ->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('selling_place');
            $table->string('selling_type');
            $table->string('item_amount');
            $table->decimal('group_price', 8, 2, true)->default(0.0);
            $table->decimal('individual_price', 8, 2, true)->default(0.0);
            $table->decimal('discount', 8, 2, true)->default(0.0)->nullable();
            $table->decimal('opened_balance', 8, 2, true)->default(0.0)->nullable();
            $table->decimal('payed', 8, 2, true)->default(0.0)->nullable();
            $table->decimal('money', 8, 2, true)->default(0.0);
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
        Schema::dropIfExists('sell_bills');
    }
}
