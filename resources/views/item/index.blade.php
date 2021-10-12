<x-layouts.bootstrap>
    <table class="table table-sm table-responsive table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('launcher.item_name') }}</th>
            <th scope="col">{{ __('launcher.item_unit_id') }}</th>
            <th scope="col">{{ __('launcher.item_group_id') }}</th>
            <th scope="col">{{ __('launcher.item_quantity_on_show') }}</th>
            <th scope="col">{{ __('launcher.item_quantity_in_stock') }}</th>
            {{--<th>Operations</th>--}}
        </tr>
        </thead>
        @if ($items)
            <tbody>
            @foreach($items as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <th scope="col">{{ $item->name }}</th>
                    <th scope="col">{{ $item->unit->name }}</th>
                    <th scope="col">{{ $item->group->name }}</th>
                    <th scope="col">{{ $item->quantity_on_show }}</th>
                    <th scope="col">{{ $item->quantity_in_stock }}</th>
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
