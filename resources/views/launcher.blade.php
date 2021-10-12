<x-layouts.bootstrap>
@if(session('message'))
    <!-- messaging -->
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
</x-layouts.bootstrap>
