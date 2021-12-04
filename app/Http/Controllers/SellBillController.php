<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\SellBill;
use Illuminate\Http\Request;

class SellBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellBill  $sellBill
     * @return \Illuminate\Http\Response
     */
    public function show(SellBill $sellBill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellBill  $sellBill
     * @return \Illuminate\Http\Response
     */
    public function edit(SellBill $sellBill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SellBill  $sellBill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SellBill $sellBill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SellBill  $sellBill
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SellBill $sellBill)
    {
        $sellBill->delete();
        return redirect()
            ->route('sell.bill');
    }

    public function print(Customer $customer)
    {
        return view('bill.sell-bill-print', [
            'customer' => $customer,
        ]);
    }

    public function dismiss_sell_bill($customer_bill_id)
    {
        $customer_bill = SellBill::where('customer_id', $customer_bill_id)->first();
        $item = Item::where('barcode', $customer_bill->item_barcode)->first();
        if ($customer_bill->selling_place == __('launcher.repository'))
        {
            $item['quantity_in_stock'] = $item['quantity_in_stock'] + $customer_bill->item_amount;
            $item->save();
        }
        if ($customer_bill->selling_place == __('launcher.show'))
        {
            $item['quantity_on_show'] = $item['quantity_on_show'] + $customer_bill->item_amount;
            $item->save();
        }
        $customer_bill->delete();
        return redirect()->route('sell.bill');
    }

    public function sell_bill_pay_part($sell_bill_id)
    {
        $sell_bill = SellBill::find($sell_bill_id);
        if (!$sell_bill)
            abort(code: 404, message: 'Not Found');

        return view('bill.sell-bill-pay-part', [
            'sell_bill' => SellBill::find($sell_bill_id),
        ]);
    }

    public function sell_bill_pay_part_update(Request $request, $sell_bill_id)
    {
        $sell_bill = SellBill::find($sell_bill_id);
        if (!$sell_bill)
            abort(code: 404, message: 'Not Found');
        $data = $request->validate(rules: [
            'payed_amount' => ['required', 'numeric'],
        ]);
        $sell_bill['payed'] = $data['payed_amount'];
        $sell_bill['money'] = $sell_bill['money'] - $data['payed_amount'];
        $sell_bill->save();
        return redirect()->route(route: 'sell.bill');
    }
}
