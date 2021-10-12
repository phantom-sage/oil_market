<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Item;
use Livewire\Component;

class SellBill extends Component
{
    public $item_barcode;
    public $item_name;
    public $item_unit;
    public $item_group;
    public $item_quantity_on_show;
    public $item_quantity_in_stock;
    public $customer_id;
    public $opened_balance;
    public $discount;
    public $payed;
    public $money;
    public $item_amount;
    public $group_price;
    public $individual_price;
    public $selling_place;
    public $selling_type;
    public $customer_bills = [];
    public $summation;

    protected $rules = [
        'item_barcode' => 'required|max:255|string',
        'item_name' => 'required|max:255|string',
        'item_unit' => 'required|max:255|string',
        'item_group' => 'required|max:255|string',
        'item_quantity_on_show' => 'sometimes|max:255',
        'item_quantity_in_stock' => 'sometimes|max:255',
        'customer_id' => 'required|integer',
        'opened_balance' => 'sometimes',
        'discount' => 'sometimes',
        'payed' => 'sometimes',
        'money' => 'required|numeric|min:0',
        'item_amount' => 'required',
        'group_price' => 'sometimes',
        'individual_price' => 'sometimes',
        'selling_place' => 'required|string',
        'selling_type' => 'required|string',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveSellBill()
    {
        $validated_data = $this->validate();
        \App\Models\SellBill::create($validated_data);
        $item = Item::where('barcode', '=', $this->item_barcode)->first();
        if ($this->selling_place == __('launcher.repository'))
        {
            $item['quantity_in_stock'] = $item['quantity_in_stock'] - $this->item_amount;
        }
        if ($this->selling_place == __('launcher.show'))
        {
            $item['quantity_on_show'] = $item['quantity_on_show'] - $this->item_amount;
        }
        $item->save();
        return redirect()
            ->route('sell.bill');
    }

    public function render()
    {
        $item_barcode = '';
        if ( ! empty($this->item_barcode) ) {
            if (Item::where('barcode', '=', $this->item_barcode)->first()) {
                $item_barcode = Item::where('barcode', '=', $this->item_barcode)
                    ->first()->barcode;
                $this->item_name = Item::where('barcode', '=', $this->item_barcode)
                    ->first()->name;
                $this->item_unit = Item::where('barcode', '=', $this->item_barcode)
                    ->first()->unit->name;
                $this->item_group = Item::where('barcode', '=', $this->item_barcode)
                    ->first()->group->name;
                $this->item_quantity_on_show = Item::where('barcode', '=', $this->item_barcode)
                    ->first()->quantity_on_show;
                $this->item_quantity_in_stock = Item::where('barcode', '=', $this->item_barcode)
                    ->first()->quantity_in_stock;
                $this->group_price = Item::where('barcode', '=', $this->item_barcode)
                    ->first()->wholesale_price;
                $this->individual_price = Item::where('barcode', '=', $this->item_barcode)
                    ->first()->selling_price;
            }
        }
        if ($this->customer_id)
        {
            $customer = Customer::find($this->customer_id);
            $this->customer_bills = $customer->sell_bills;
            $this->summation = $this->customer_bills->sum('money');
        }
        if ($this->selling_type == __('launcher.individual'))
            $this->money = $this->individual_price * $this->item_amount - $this->discount;
        if ($this->selling_type == __('launcher.group'))
            $this->money = $this->group_price * $this->item_amount - $this->discount;
        $customers = Customer::all();
        return view('livewire.sell-bill', [
            'item_barcode' => $item_barcode,
            'item_name' => $this->item_name,
            'item_unit' => $this->item_unit,
            'item_group' => $this->item_group,
            'item_quantity_on_show' => $this->item_quantity_on_show,
            'item_quantity_in_stock' => $this->item_quantity_in_stock,
            'customer_bills' => $this->customer_bills,
            'customers' => $customers,
            'summation' => $this->summation,
        ]);
    }
}
