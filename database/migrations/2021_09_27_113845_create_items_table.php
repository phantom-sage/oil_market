<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('barcode');
            $table->decimal('purchasing_price', 8, 2, true); // سعر الشراء
            $table->decimal('wholesale_price', 8, 2, true); // سعر الجملة
            $table->decimal('selling_price', 8, 2, true); // سعر البيع
            $table->unsignedInteger('quantity_on_show'); // الكمية بالمعرض
            $table->unsignedInteger('quantity_in_stock'); // الكمية بالمخزن
            $table->foreignId('group_id')
                ->references('id')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('unit_id')
                ->references('id')
                ->on('units')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('items');
    }
}
