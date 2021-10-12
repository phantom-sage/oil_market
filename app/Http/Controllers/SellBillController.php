<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
}
