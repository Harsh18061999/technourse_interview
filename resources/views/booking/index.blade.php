<x-layout>
    <div class="my-2">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Booking List</h2>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">Create Booking</a>
        </div>
        <div class="card p-4 table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-layout>
