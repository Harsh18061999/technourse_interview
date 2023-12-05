<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Booking;
class DaySelction implements ValidationRule
{

    protected $startTime;
    protected $endTime;

    public function __construct($startTime, $endTime)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }
    
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $booking = Booking::select('booking_type')->whereDate('booking_date', $value)->first();
        if ($booking) {
            $booking_type = $booking->booking_type;
            if ($booking_type == 'full_day') {
                $fail('Sorry, the full day is already booked for this date.');
            } else if ($booking_type == 'half_day' && reqquest('booking_type') == 'full_day') {
                $fail('Sorry, the full day or half day is already booked for this date.');
            }
        }
    }
}
