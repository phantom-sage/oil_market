<x-layouts.bootstrap>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 mt-5">
                <div class="card shadow-sm">
                    <h5 class="card-header">{{ __('launcher.add_item') }}</h5>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('items.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold mb-2">{{ __('launcher.item_name') }}</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('launcher.item_name') }}">
                                @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="item_barcode" class="form-label fw-bold mb-2">{{ __('launcher.item_barcode') }}</label>
                                <input type="text" name="barcode" class="form-control" id="item_barcode" placeholder="{{ __('launcher.item_barcode') }}">
                                @error('barcode')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="item_purchasing_price" class="form-label fw-bold mb-2">{{ __('launcher.item_purchasing_price') }}</label>
                                <input type="text" name="purchasing_price" class="form-control" id="item_purchasing_price" placeholder="{{ __('launcher.item_purchasing_price') }}">
                                @error('purchasing_price')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="item_wholesale_price" class="form-label fw-bold mb-2">{{ __('launcher.item_wholesale_price') }}</label>
                                <input type="text" name="wholesale_price" class="form-control" id="item_wholesale_price" placeholder="{{ __('launcher.item_wholesale_price') }}">
                                @error('wholesale_price')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="item_selling_price" class="form-label fw-bold mb-2">{{ __('launcher.item_selling_price') }}</label>
                                <input type="text" name="selling_price" class="form-control" id="item_selling_price" placeholder="{{ __('launcher.item_selling_price') }}">
                                @error('selling_price')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="item_quantity_on_show" class="form-label fw-bold mb-2">{{ __('launcher.item_quantity_on_show') }}</label>
                                <input type="number" name="quantity_on_show" class="form-control" id="item_quantity_on_show" placeholder="{{ __('launcher.item_quantity_on_show') }}">
                                @error('quantity_on_show')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="item_quantity_in_stock" class="form-label fw-bold mb-2">{{ __('launcher.item_quantity_in_stock') }}</label>
                                <input type="number" name="quantity_in_stock" class="form-control" id="item_quantity_in_stock" placeholder="{{ __('launcher.item_quantity_in_stock') }}">
                                @error('quantity_in_stock')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="item_group_id" class="form-label fw-bold mb-2">{{ __('launcher.item_group_id') }}</label>
                                <select name="group_id" id="item_group_id" class="form-select" aria-label="Group selection">
                                    @foreach($groups as $group)
                                        <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('group_id')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="item_unit_id" class="form-label fw-bold mb-2">{{ __('launcher.item_unit_id') }}</label>
                                <select name="unit_id" id="item_unit_id" class="form-select" aria-label="Units selection">
                                    @foreach($units as $unit)
                                        <option value="{{ $unit['id'] }}">{{ $unit['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-success" id="submitBtn" type="submit">{{ __('launcher.add_item') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.bootstrap>

