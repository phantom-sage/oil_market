<x-layouts.bootstrap>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 mt-5">
                <div class="card shadow-sm">
                    <h5 class="card-header">{{ __('launcher.add_group') }}</h5>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('groups.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold mb-2">{{ __('launcher.group_name') }}</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('launcher.group_name') }}">
                                @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success" id="submitBtn" type="submit">{{ __('launcher.add_group') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.bootstrap>

