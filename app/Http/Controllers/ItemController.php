<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;

class ItemController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create', [
            'groups' => Group::all(),
            'units' => Unit::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'unique:items', 'min:3', 'max:255', 'required'],
            'barcode' => ['string', 'min:1', 'max:255', 'required'],
            'purchasing_price' => ['required', 'numeric', 'min:1'],
            'wholesale_price' => ['required', 'numeric', 'min:1'],
            'selling_price' => ['required', 'numeric', 'min:1'],
            'quantity_on_show' => ['required', 'integer', 'numeric', 'min:0'],
            'quantity_in_stock' => ['required', 'integer', 'numeric', 'min:0'],
            'group_id' => ['required', 'integer'],
            'unit_id' => ['required', 'integer'],
        ]);
        $item = new Item();
        $item['name'] = $data['name'];
        $item['barcode'] = $data['barcode'];
        $item['purchasing_price'] = $data['purchasing_price'];
        $item['wholesale_price'] = $data['wholesale_price'];
        $item['selling_price'] = $data['selling_price'];
        $item['quantity_on_show'] = $data['quantity_on_show'];
        $item['quantity_in_stock'] = $data['quantity_in_stock'];
        $item['group_id'] = $data['group_id'];
        $item['unit_id'] = $data['unit_id'];
        $item->save();
        return redirect()->route('launcher')
            ->with('message', __('messages.new_item_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
