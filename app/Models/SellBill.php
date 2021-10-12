<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellBill extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'item_barcode', 'item_name',
        'item_unit', 'item_group',
        'item_quantity_on_show', 'item_quantity_in_stock',
        'customer_id', 'selling_place',
        'selling_type', 'item_amount',
        'group_price', 'individual_price',
        'discount', 'opened_balance',
        'payed', 'money'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
