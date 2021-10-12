<x-layouts.bootstrap>
    <div class="container">
        <div class="row align-items-center">
        @if(session('error_message'))
            <!-- messaging -->
                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('error_message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="w-100"></div>
            <div class="col-6 mt-5">
                <div class="card shadow-sm">
                    <h5 class="card-header">{{ __('launcher.move_to_show') }}</h5>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('items.move.to.show') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="itemId" class="form-label fw-bold mb-2">{{ __('launcher.item_name') }}</label>
                                <select name="item_id" id="itemId" class="form-select" aria-label="Item name selection">
                                    @foreach($items as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="itemAmount" class="form-label fw-bold mb-2">{{ __('launcher.amount') }}</label>
                                <input type="number" name="item_amount" class="form-control" id="itemAmount" placeholder="{{ __('launcher.amount') }}">
                                @error('item_amount')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-success" id="submitBtn" type="submit">{{ __('launcher.move') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.bootstrap>

