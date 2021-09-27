<x-layouts.bootstrap>
@if(session('message'))
    <!-- messaging -->
        <div class="row">
            <div class="col-4 mx-auto">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <h1>Launcher main screen</h1>
</x-layouts.bootstrap>
