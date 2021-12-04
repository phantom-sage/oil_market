<x-layouts.bootstrap>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4 mt-5">
                <div class="card shadow-sm">
                    <h5 class="card-header">{{ __('launcher.pay_part') }}</h5>
                    <div class="card-body">
                        <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{ route('bill.sell.pay.part.update', $sell_bill->id) }}">
                            @csrf
                            @method('PUT')
                                <!-- amout -->
                                <div class="col-md-6">
                                    <label for="payedAmount" class="form-label">{{ __('launcher.amount') }}</label>
                                    <input type="number" name="payed_amount" class="form-control" id="payedAmount">
                                    @error('payed_amount') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">{{ __('launcher.save') }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.bootstrap>

