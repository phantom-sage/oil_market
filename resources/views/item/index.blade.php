<x-layouts.bootstrap>
    <div class="col-6 mx-auto">
        <div class="card shadow-sm">
            <h5 class="card-header">{{ __('launcher.update_item_price') }}</h5>
            <div class="card-body">
                <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{ route('items.update.prices') }}">
                    @method('PUT')
                    @csrf

                    <div class="mb-3 col-4">
                        <label for="items" class="form-label fw-bold mb-2">{{ __('launcher.items') }}</label>
                        <select name="items" id="items" class="form-select" aria-label="Items selection">
                            <option value="{{ __('launcher.all') }}">{{ __('launcher.all') }}</option>
                            @foreach($items as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        @error('items')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3 col-4">
                        <label for="type" class="form-label fw-bold mb-2">{{ __('launcher.type') }}</label>
                        <select name="type" id="type" class="form-select" aria-label="Type selection">
                            <option value="plus" selected>{{ __('launcher.plus') }}</option>
                            <option value="minus">{{ __('launcher.minus') }}</option>
                        </select>
                        @error('type')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3 col-4">
                        <label for="precentage" class="form-label fw-bold mb-2">{{ __('launcher.percentage') }}</label>
                        %<input type="text" name="percentage" class="form-control" id="percentage" placeholder="{{ __('launcher.percentage') }}">
                        @error('percentage')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3 col-3">
                        <button class="btn btn-success" id="submitBtn" type="submit">{{ __('launcher.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <table class="table table-sm table-responsive table-hover">
        <thead>
        <tr>
            <th scope="col">{{ __('launcher.image') }}</th>
            <th scope="col">#</th>
            <th scope="col">{{ __('launcher.item_name') }}</th>
            <th scope="col">{{ __('launcher.item_unit_id') }}</th>
            <th scope="col">{{ __('launcher.item_group_id') }}</th>
            <th scope="col">{{ __('launcher.item_quantity_on_show') }}</th>
            <th scope="col">{{ __('launcher.item_quantity_in_stock') }}</th>
            <th scope="col">{{ __('launcher.item_selling_price') }}</th>
            <th scope="col">{{ __('launcher.item_purchasing_price') }}</th>
            <th scope="col">{{ __('launcher.item_wholesale_price')}}</th>
        </tr>
        </thead>
        @if ($items)
            <tbody>
            @foreach($items as $item)
                <tr>
                    <th scope="row"><img src="storage/{{ $item->image }}" class="rounded ml-auto d-block img-fluid img-thumbnail" width="64" height="64"></th>
                    <th scope="row">{{ $item->id }}</th>
                    <th scope="col">{{ $item->name }}</th>
                    <th scope="col">{{ $item->unit->name }}</th>
                    <th scope="col">{{ $item->group->name }}</th>
                    <th scope="col">{{ $item->quantity_on_show }}</th>
                    <th scope="col">{{ $item->quantity_in_stock }}</th>
                    <th scope="col">{{ $item->selling_price }}</th>
                    <th scope="col">{{ $item->purchasing_price }}</th>
                    <th scope="col">{{ $item->wholesale_price }}</th>
                    {{--<td>
                        <a onclick="event.preventDefault();document.querySelector('#updateItemForm').submit();" class="btn btn-primary">{{ __('launcher.update') }}</a>
                        <form id="updateItemForm" action="{{ route('items.update', $item->id) }}" method="post" class="hidden">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="item" value="{{ $item }}">
                        </form>
                    </td> /
                    <td>
                        <a onclick="event.preventDefault();document.querySelector('#deleteItemForm').submit();" class="btn btn-danger">{{ __('launcher.delete') }}</a>
                        <form id="deleteItemForm" action="{{ route('items.destroy', $item->id) }}" method="post" class="hidden">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="item" value="{{ $item }}">
                        </form>
                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
</x-layouts.bootstrap>
