<x-layout>
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Booking Create</h2>
            <a href="{{ route('bookings.index') }}" class="btn btn-primary">Booking List</a>
        </div>
        <div class="card p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ isset($booking) ? route('bookings.update',$booking->id) : route('bookings.store') }}" method="POST">
                @csrf
                @if(isset($booking))
                    @method("PUT")
                @endif
                <input type="hidden" name="booking_id" id="" value="{{isset($booking) ? $booking->id : ''}}">
                <div class="row">
                    <div class="mb-3  col-md-6 col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ isset($booking) ? $booking->name : old('name') }}"
                            id="name" placeholder="Enter your full name !">
                    </div>
                    <div class="mb-3 col-md-6 col-12">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" value="{{ isset($booking) ? $booking->email : old('email') }}" name="email" class="form-control"
                            id="email" aria-describedby="emailHelp" placeholder="Enter your email address !"
                            autocomplete="off">
                    </div>
                    <div class="mb-3 col-md-6 col-12 d-flex flex-column justify-content-around">
                        <label class="mr-2">Booing Type : </label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking_type" id="inlineRadio1"
                                    value="full_day" @checked(isset($booking) ? $booking->booking_type == 'full_day' : 'full_day' === old('booking_type'))>
                                <label class="form-check-label" for="inlineRadio1">Full Day</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking_type" id="inlineRadio2"
                                    value="half_day" @checked( isset($booking) ? $booking->booking_type == 'half_day' : 'half_day' === old('booking_type'))>
                                <label class="form-check-label" for="inlineRadio2">Half Day</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 form-check  col-md-6 col-12">
                        <label for="datepicker" class="form-label">Date</label>
                        <input class="form-control" name="booking_date" id="datepicker"
                            value="{{ isset($booking) ? $booking->booking_date : old('booking_date') }}">
                    </div>
                    <div class="mb-3 col-md-6 col-12 d-flex flex-column justify-content-around">
                        <label class="mr-2">Booking Sloat : </label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking_slot"
                                    id="booking_slotRadio1" value="morning" @checked(isset($booking) ? $booking->booking_slot === 'morning' : 'morning' === old('booking_slot'))>
                                <label class="form-check-label" for="booking_slotRadio1">Morning</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking_slot"
                                    id="booking_slotRadio2" value="evening" @checked( isset($booking) ? $booking->booking_slot === 'evening' : 'evening' === old('booking_slot'))>
                                <label class="form-check-label" for="booking_slotRadio2">Evening</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 form-check  col-md-6 col-12">
                        <label for="timePicker" class="form-label">Time</label>
                        <input type="time" class="form-control" name="booking_time"
                            value="{{ isset($booking) ? $booking->booking_time :  old('booking_time') }}">
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function() {
                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
        </script>
    @endpush
</x-layout>
