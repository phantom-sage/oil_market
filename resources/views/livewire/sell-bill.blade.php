<div>
    <form class="row g-3" wire:submit.prevent="saveSellBill">
        @csrf
            <!-- item barcode -->
            <div class="col-md-6">
                <label for="itemBarcode" class="form-label">{{ __('launcher.item_barcode') }}</label>
                <input @if($item_barcode) value="{{ $item_barcode }}" @endif wire:model="item_barcode" type="text" class="form-control" id="itemBarcode">
                @error('item_barcode') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- item name -->
            <div class="col-md-6">
                <label for="itemName" class="form-label">{{ __('launcher.item_name') }}</label>
                <input wire:model="item_name" @if ($item_name) value="{{ $item_name }}" @endif type="text" class="form-control" id="itemName">
                @error('item_name') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- item unit -->
            <div class="col-md-6">
                <label for="itemUnit" class="form-label">{{ __('launcher.item_unit_id') }}</label>
                <input wire:model="item_unit" @if($item_unit) value="{{ $item_unit }}" @endif type="text" class="form-control" id="itemUnit">
                @error('item_unit') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- item group -->
            <div class="col-md-6">
                <label for="itemGroup" class="form-label">{{ __('launcher.item_group_id') }}</label>
                <input wire:model="item_group" @if($item_group) value="{{ $item_group }}" @endif type="text" class="form-control" id="itemGroup">
                @error('item_group') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- item quantity on show -->
            <div class="col-md-6">
                <label for="itemQuantityOnShow" class="form-label">{{ __('launcher.item_quantity_on_show') }}</label>
                <input wire:model="item_quantity_on_show" @if($item_quantity_on_show) value="{{ $item_quantity_on_show }}" @endif readonly disabled type="number" class="form-control" id="itemQuantityOnShow">
                @error('item_quantity_on_show') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- item quantity in stock -->
            <div class="col-md-6">
                <label for="itemQuantityInStock" class="form-label">{{ __('launcher.item_quantity_in_stock') }}</label>
                <input wire:model="item_quantity_in_stock" @if($item_quantity_in_stock) value="{{ $item_quantity_in_stock }}" @endif readonly disabled type="number" class="form-control" id="itemQuantityInStock">
                @error('item_quantity_in_stock') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- group selling price -->
            <div class="col-md-6">
                <label for="groupPrice" class="form-label">{{ __('launcher.group_price') }}</label>
                <input wire:model="group_price" type="text" class="form-control" id="groupPrice" placeholder="0.0" min="0.0">
                @error('group_price') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- individual selling price -->
            <div class="col-md-6">
                <label for="individualPrice" class="form-label">{{ __('launcher.individual_price') }}</label>
                <input wire:model="individual_price" type="text" class="form-control" id="individualPrice" placeholder="0.0" min="0.0">
                @error('individual_price') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <hr>

            <!-- customer -->
            <div class="col-12">
                <label for="customer" class="form-label">{{ __('launcher.customer') }}</label>
                <select wire:model="customer_id" class="form-select" id="customer">
                    <option selected>Choose...</option>
                    @foreach($customers as $customer)
                    <option value="{{ $customer['id'] }}">{{ $customer['name'] }}</option>
                    @endforeach
                    @error('customer_id') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                </select>
            </div>

            <!-- selling place -->
            <div class="col-md-6">
                <label for="sellingPlace" class="form-label">{{ __('launcher.selling_place') }}</label>
                <select wire:model="selling_place" id="sellingPlace" class="form-select">
                    <option selected>Choose...</option>
                    <option value="{{ __('launcher.repository') }}">{{ __('launcher.repository') }}</option>
                    <option value="{{ __('launcher.show') }}">{{ __('launcher.show') }}</option>
                    @error('selling_place') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                </select>
            </div>

            <!-- selling type -->
            <div class="col-md-6">
                <label for="sellingType" class="form-label">{{ __('launcher.selling_type') }}</label>
                <select wire:model="selling_type" id="sellingType" class="form-select">
                    <option selected>Choose...</option>
                    <option value="{{ __('launcher.group') }}">{{ __('launcher.group') }}</option>
                    <option value="{{ __('launcher.individual') }}">{{ __('launcher.individual') }}</option>
                    @error('selling_type') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                </select>
            </div>

            <!-- amount -->
            <div class="col-md-4">
                <label for="itemAmount" class="form-label">{{ __('launcher.amount') }}</label>
                <input wire:model="item_amount" type="text" class="form-control" id="itemAmount" placeholder="0" min="0">
                @error('item_amount') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- opened balance -->
            <div class="col-md-3">
                <label for="openedBalance" class="form-label">{{ __('launcher.opened_balance') }}</label>
                <input wire:model="opened_balance" type="text" class="form-control" id="openedBalance" placeholder="0.0" min="0.0">
                @error('opened_balance') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <!-- discount -->
            <div class="col-md-3">
                <label for="discount" class="form-label">{{ __('launcher.discount') }}</label>
                <input wire:model="discount" type="text" class="form-control" id="discount" placeholder="0.0" min="0.0">
                @error('discount') <span class="error invalid-feedback">{{ $message }}</span> @enderror
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
    <!-- customer_bills -->
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
        @if ($customer_bills)
        <tbody>
        @foreach($customer_bills as $customer_bill)
        <tr>
            <th scope="row">{{ $customer_bill->id }}</th>
            <td>{{ $customer_bill->item_name }}</td>
            <td>{{ $customer_bill->item_amount }}</td>
            <td>{{ $customer_bill->money }}</td>
            <td><a class="btn btn-danger" href="{{ route('sell.bill.destroy', $customer_bill->id) }}">{{ __('launcher.delete') }}</a></td>
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
    <hr>
    <div class="col-4">
        <a class="btn btn-success"
           @if ($customer_id) href="{{ route('sell.bill.customer.print', $customer_id) }}" @endif
        >Print</a>
    </div>
</div>
