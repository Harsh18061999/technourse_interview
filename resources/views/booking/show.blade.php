<x-layout>
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Booking View</h2>
            <a href="{{ route('bookings.index') }}" class="btn btn-primary">Booking List</a>
        </div>
        <div class="card p-4 table-responsive">
            <p><strong>Name</strong> : {{ $booking->name }}</p>
            <p><strong>Email</strong> : {{ $booking->email }}</p>
            <p><strong>Booking Type</strong> : {{ $booking->booking_type }}</p>
            <p><strong>Booking Slot</strong> : {{ $booking->booking_slot }}</p>
            <p><strong>Booking Date</strong> : {{ $booking->booking_date }}</p>
            <p><strong>Booking Time</strong> : {{ $booking->booking_time }}</p>
            <div class="text-end">
                <a href="{{route("bookings.edit",$booking->id)}}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</x-layout>
