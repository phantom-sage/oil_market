<x-layouts.bootstrap>
    <table class="table table-sm table-responsive">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('launcher.item_name') }}</th>
            <th>Operations</th>
        </tr>
        </thead>
        @if ($customers)
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <th scope="row">{{ $customer->id }}</th>
                    <th scope="col">{{ $customer->name }}</th>
                    <td>
                        <a onclick="event.preventDefault();document.querySelector('#deleteCustomerForm').submit();" class="btn btn-danger">{{ __('launcher.delete') }}</a>
                        <form id="deleteCustomerForm" action="{{ route('customers.destroy', $customer->id) }}" method="post" class="hidden">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="customer" value="{{ $customer }}">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
</x-layouts.bootstrap>
