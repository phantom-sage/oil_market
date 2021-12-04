<div>
    <div class="row g-3">
        <!-- from date -->
        <div class="col-md-6">
            <label for="fromDate" class="form-label">{{ __('launcher.from_date') }}</label>
            <input wire:model="from_date" type="date" name="from_date" class="form-control" id="fromDate">
        </div>

        <!-- to date -->
        <div class="col-md-6">
            <label for="toDate" class="form-label">{{ __('launcher.to_date') }}</label>
            <input wire:model="to_date" type="date" name="to_date" class="form-control" id="toDate">
        </div>

        <div class="col-3">
            <button type="button" wire:click="get_sell_bills" class="btn btn-primary">{{ __('launcher.sell_reports') }}</button>
        </div>

        <div class="col-3">
            <button type="button" wire:click="get_buy_bills" class="btn btn-primary">{{ __('launcher.buy_reports') }}</button>
        </div>
    </div>
    <hr>
    <div class="col">
        @if($buy_bills)
            <table class="table table-sm table-responsive">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('launcher.vendor_name') }}</th>
                    <th scope="col">{{ __('launcher.item_name') }}</th>
                    <th scope="col">{{ __('launcher.amount') }}</th>
                    <th scope="col">{{ __('launcher.money') }}</th>
                    <th scope="col">{{ __('launcher.when_bought') }}</th>
                </tr>
                </thead>
                @if ($buy_bills)
                    <tbody>
                    @foreach($buy_bills as $buy_bill)
                        <tr>
                            <th scope="row">{{ $buy_bill->id }}</th>
                            <td>{{ $buy_bill->vendor->name }}</td>
                            <td>{{ $buy_bill->item_name }}</td>
                            <td>{{ $buy_bill->amount }}</td>
                            <td>{{ $buy_bill->money }}</td>
                            <td>{{ $buy_bill->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        @endif
        <hr class="my-5">
        @if($sell_bills)
            <table class="table table-sm table-responsive">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('launcher.customer_name') }}</th>
                    <th scope="col">{{ __('launcher.item_name') }}</th>
                    <th scope="col">{{ __('launcher.amount') }}</th>
                    <th scope="col">{{ __('launcher.money') }}</th>
                    <th scope="col">{{ __('launcher.when_sold') }}</th>
                </tr>
                </thead>
                @if ($sell_bills)
                    <tbody>
                    @foreach($sell_bills as $sell_bill)
                        <tr>
                            <th scope="row">{{ $sell_bill->id }}</th>
                            <td>{{ $sell_bill->customer->name }}</td>
                            <td>{{ $sell_bill->item_name }}</td>
                            <td>{{ $sell_bill->item_amount }}</td>
                            <td>{{ $sell_bill->money }}</td>
                            <td>{{ $sell_bill->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        @endif
    </div>
</div>
