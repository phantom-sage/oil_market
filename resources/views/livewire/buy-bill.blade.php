<div>
    <form class="row g-3" wire:submit.prevent="saveBuyBill">
        @csrf

        <!-- vendor -->
        <div class="col-md-4">
            <label for="vendor" class="form-label">{{ __('launcher.vendor') }}</label>
            <select wire:model="vendor_id" class="form-select" id="vendor">
                <option selected>Choose...</option>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor['id'] }}">{{ $vendor['name'] }}</option>
                @endforeach
                @error('vendor_id') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </select>
        </div>

        <!-- payment method -->
        <div class="col-md-4">
            <label for="paymentMethod" class="form-label">{{ __('launcher.payment_method') }}</label>
            <select wire:model="payment_method" class="form-select" id="paymentMethod">
                <option selected>Choose...</option>
                @foreach($payment_methods as $payment_method)
                    <option value="{{ $payment_method }}">{{ $payment_method }}</option>
                @endforeach
                @error('payment_method') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </select>
        </div>

        <!-- bill date -->
        <div class="col-md-4">
            <label for="billDate" class="form-label">{{ __('launcher.bill_date') }}</label>
            <input value="{{ now()->format('d/m/Y') }}" readonly disabled type="text" class="form-control" id="billDate">
        </div>

        <!-- item barcode -->
        <div class="col-md-3">
            <label for="itemBarcode" class="form-label">{{ __('launcher.item_barcode') }}</label>
            <input @if($item_barcode) value="{{ $item_barcode }}" @endif wire:model="item_barcode" type="text" class="form-control" id="itemBarcode">
            @error('item_barcode') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- item name -->
        <div class="col-md-3">
            <label for="itemName" class="form-label">{{ __('launcher.item_name') }}</label>
            <input wire:model="item_name" @if ($item_name) value="{{ $item_name }}" @endif type="text" class="form-control" id="itemName">
            @error('item_name') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- item unit -->
        <div class="col-md-3">
            <label for="itemUnit" class="form-label">{{ __('launcher.item_unit_id') }}</label>
            <input wire:model="item_unit" @if($item_unit) value="{{ $item_unit }}" @endif type="text" class="form-control" id="itemUnit">
            @error('item_unit') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- item group -->
        <div class="col-md-3">
            <label for="itemGroup" class="form-label">{{ __('launcher.item_group_id') }}</label>
            <input wire:model="item_group" @if($item_group) value="{{ $item_group }}" @endif type="text" class="form-control" id="itemGroup">
            @error('item_group') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>


        <!-- dropping place -->
        <div class="col-md-4">
            <label for="droppingPlace" class="form-label">{{ __('launcher.dropping_place') }}</label>
            <select wire:model="dropping_place" class="form-select" id="droppingPlace">
                <option selected>Choose...</option>
                @for($i = 0; $i < count($dropping_places); $i++)
                    <option value="{{ $dropping_places[$i] }}">{{ $dropping_places[$i] }}</option>
                @endfor
                @error('dropping_place') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </select>
        </div>


        <!-- buying type -->
        <div class="col-md-4">
            <label for="buyingType" class="form-label">{{ __('launcher.buying_type') }}</label>
            <select wire:model="buying_type" class="form-select" id="buyingType">
                <option selected>Choose...</option>
                @for($i = 0; $i < count($buying_types); $i++)
                    <option value="{{ $buying_types[$i] }}">{{ $buying_types[$i] }}</option>
                @endfor
                @error('buying_type') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </select>
        </div>


        <!-- amount -->
        <div class="col-md-4">
            {{ $amount }}
            <label for="amount" class="form-label">{{ __('launcher.amount') }}</label>
            <input wire:model="amount" type="number" class="form-control" id="amount">
            @error('amount') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- group selling price -->
        <div class="col-md-3">
            <label for="groupPrice" class="form-label">{{ __('launcher.group_price') }}</label>
            <input wire:model="group_price" type="number" class="form-control" id="groupPrice" placeholder="0.0" min="0.0">
            @error('group_price') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- buying price (for individual item) -->
        <div class="col-md-3">
            <label for="buyingPrice" class="form-label">{{ __('launcher.item_purchasing_price') }}</label>
            <input wire:model="buying_price" type="number" class="form-control" id="buyingPrice" placeholder="0.0">
            @error('buying_price') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- item quantity on show -->
        <div class="col-md-3">
            {{ $item_quantity_on_show }}
            <label for="itemQuantityOnShow" class="form-label">{{ __('launcher.item_quantity_on_show') }}</label>
            <input wire:model="item_quantity_on_show" type="number" class="form-control" id="itemQuantityOnShow">
            @error('item_quantity_on_show') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- item quantity in stock -->
        <div class="col-md-3">
            {{ $item_quantity_in_stock }}
            <label for="itemQuantityInStock" class="form-label">{{ __('launcher.item_quantity_in_stock') }}</label>
            <input wire:model="item_quantity_in_stock" type="number" class="form-control" id="itemQuantityInStock">
            @error('item_quantity_in_stock') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- payed -->
        <div class="col-md-3">
            <label for="payed" class="form-label">{{ __('launcher.payed') }}</label>
            <input wire:model="payed" type="text" class="form-control" id="payed" placeholder="0.0" min="0.0">
            @error('payed') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <!-- money -->
        <div class="col-md-3">
            <label for="money" class="form-label">{{ __('launcher.money') }}</label>
            <input wire:model="money" type="text" class="form-control" id="money" placeholder="0.0" min="0.0">
            @error('money') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">{{ __('launcher.save') }}</button>
        </div>

    </form>
    <hr>
    <!-- vendor_bills -->
    <table class="table table-sm table-responsive">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('launcher.item_name') }}</th>
            <th scope="col">{{ __('launcher.amount') }}</th>
            <th scope="col">{{ __('launcher.money') }}</th>
            <th>Operations</th>
        </tr>
        </thead>
        @if ($vendor_bills)
            <tbody>
            @foreach($vendor_bills as $vendor_bill)
                <tr>
                    <th scope="row">{{ $vendor_bill->id }}</th>
                    <td>{{ $vendor_bill->item_name }}</td>
                    <td>{{ $vendor_bill->amount }}</td>
                    <td>{{ $vendor_bill->money }}</td>
{{--                    <td><a class="btn btn-danger" href="{{ route('sell.bill.destroy', $customer_bill->id) }}">{{ __('launcher.delete') }}</a></td>--}}
                </tr>
            @endforeach
            <tr>
                <th scope="row">-</th>
                <td>-</td>
                <td>-</td>
                <td>{{ __('launcher.summation') }}</td>
                <td>{{ $summation }}</td>
            </tr>
            </tbody>
        @endif
    </table>
{{--    <hr>--}}
{{--    <div class="col-4">--}}
{{--        <a class="btn btn-success"--}}
{{--           @if ($customer_id) href="{{ route('sell.bill.customer.print', $customer_id) }}" @endif--}}
{{--        >Print</a>--}}
{{--    </div>--}}
</div>
