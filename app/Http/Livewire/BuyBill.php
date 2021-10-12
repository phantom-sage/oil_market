<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Vendor;
use Livewire\Component;

class BuyBill extends Component
{
    public $vendor_id;
    public $payment_method;
    public $item_barcode;
    public $item_name;
    public $item_unit;
    public $item_group;
    public $dropping_place;
    public $buying_type;
    public $amount;
    public $group_price;
    public $buying_price;
    public $item_quantity_in_stock;
    public $item_quantity_on_show;
    public $payed;
    public $money;
    public $vendor_bills;
    public $summation;

    protected $rules = [
        'item_barcode' => ['required'],
        'item_name' => ['required'],
        'item_unit' => ['required'],
        'item_group' => ['required'],
        'item_quantity_in_stock' => ['required'],
        'item_quantity_on_show' => ['required'],
        'vendor_id' => ['required'],
        'payment_method' => ['required'],
        'dropping_place' => ['required'],
        'buying_type' => ['required'],
        'amount' => ['required'],
        'group_price' => ['sometimes'],
        'buying_price' => ['sometimes'],
        'payed' => ['sometimes'],
        'money' => ['required'],
    ];

    public function saveBuyBill()
    {
        if ($this->dropping_place != null)
        {
            if ($this->dropping_place == __('launcher.repository'))
            {
                $item = Item::where('barcode', $this->item_barcode)->first();
                $item['quantity_in_stock'] = $item['quantity_in_stock'] + $this->amount;
                $item->save();

                $buy_bill = new \App\Models\BuyBill();
                $buy_bill['item_barcode'] = $this->item_barcode;
                $buy_bill['item_name'] = $this->item_name;
                $buy_bill['group_name'] = $this->item_group;
                $buy_bill['unit_name'] = $this->item_unit;
                $buy_bill['dropping_place'] = $this->dropping_place;
                $buy_bill['buying_type'] = $this->buying_type;
                $buy_bill['amount'] = $this->amount;
                $buy_bill['group_price'] = $this->group_price ?? 0.0;
                $buy_bill['individual_price'] = $this->buying_price ?? 0.0;
                $buy_bill['payed'] = $this->payed ?? 0.0;
                $buy_bill['money'] = $this->money;
                $buy_bill['item_quantity_on_show'] = $this->item_quantity_on_show;
                $buy_bill['item_quantity_in_stock'] = $this->item_quantity_in_stock;
                $buy_bill['vendor_id'] = $this->vendor_id;
                $buy_bill['payment_method'] = $this->payment_method;
                $buy_bill->save();
                return redirect()
                    ->route('buy.bill')
                    ->with('message', 'Buyed successfully');
            }
            else if ($this->dropping_place == __('launcher.show'))
            {
                $item = Item::where('barcode', $this->item_barcode)->first();
                $item['quantity_on_show'] = $item['quantity_on_show'] + $this->amount;
                $item->save();

                $buy_bill = new \App\Models\BuyBill();
                $buy_bill['item_barcode'] = $this->item_barcode;
                $buy_bill['item_name'] = $this->item_name;
                $buy_bill['group_name'] = $this->item_group;
                $buy_bill['unit_name'] = $this->item_unit;
                $buy_bill['dropping_place'] = $this->dropping_place;
                $buy_bill['buying_type'] = $this->buying_type;
                $buy_bill['amount'] = $this->amount;
                $buy_bill['group_price'] = $this->group_price ?? 0.0;
                $buy_bill['individual_price'] = $this->buying_price ?? 0.0;
                $buy_bill['payed'] = $this->payed ?? 0.0;
                $buy_bill['money'] = $this->money;
                $buy_bill['item_quantity_on_show'] = $this->item_quantity_on_show;
                $buy_bill['item_quantity_in_stock'] = $this->item_quantity_in_stock;
                $buy_bill['vendor_id'] = $this->vendor_id;
                $buy_bill['payment_method'] = $this->payment_method;
                $buy_bill->save();
                return redirect()
                    ->route('buy.bill')
                    ->with('message', 'Buyed successfully');
            }
        }
    }


    public function render()
    {
        if ($this->item_barcode != null)
        {
            if (Item::where('barcode', $this->item_barcode)->first() != null)
            {
                $item = Item::where('barcode', $this->item_barcode)->first();
                $this->item_name = $item['name'];
                $this->item_group = $item->group->name;
                $this->item_unit = $item->unit->name;
                $this->item_quantity_in_stock = $item['quantity_in_stock'];
                $this->item_quantity_on_show = $item['quantity_on_show'];
            }
        }
        if ($this->buying_type == __('launcher.group'))
        {
            $this->money = $this->amount * $this->group_price - $this->payed;
        }
        if ($this->buying_type == __('launcher.individual'))
        {
            $this->money = $this->amount * $this->buying_price - $this->payed;
        }
        if ($this->vendor_id != null)
        {
            $vendor = Vendor::find($this->vendor_id);
            $this->vendor_bills = $vendor->buy_bills;
            $this->summation = $vendor->buy_bills->sum('money');
        }
        return view('livewire.buy-bill', [
            'vendors' => Vendor::all(),
            'payment_methods' => [
                __('launcher.bankak'),
                __('launcher.cash'),
                __('launcher.postpaid'),
            ],
            'dropping_places' => [
                __('launcher.repository'),
                __('launcher.show'),
            ],
            'buying_types' => [
                __('launcher.group'),
                __('launcher.individual'),
            ],
        ]);
    }
}
