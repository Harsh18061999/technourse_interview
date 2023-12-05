<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\BookingDataTable;
use App\Http\Requests\BookingPostRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
class BookingController extends Controller
{
    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BookingDataTable $dataTable)
    {
        return $dataTable->render('booking.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingPostRequest $request)
    {
        $checkRule = $this->checkRule($request);
        if ($checkRule != '') {
            return back()
                ->withInput()
                ->withErrors(['error', $checkRule]);
        }

        DB::beginTransaction();
        try {
            $this->booking->create($request->only(['name', 'email', 'booking_type', 'booking_slot', 'booking_date', 'booking_time']));
            DB::commit();
            return redirect()
                ->route('bookings.index')
                ->with('success', __('booking.BOOKING_CREATE'));
        } catch (Exception $e) {
            DB::rollBack();
            return rediect()->back();
        }
    }

    public function checkRule($request, $id = null)
    {
        $booking = $this->booking
            ->whereDate('booking_date', $request->booking_date)
            ->when($id, function ($query) use ($id) {
                $query->where('id', '!=', $id);
            })
            ->first();
        $error = '';
        if ($booking) {
            $booking_type = $booking->booking_type;
            if ($booking_type == 'full_day') {
                $error = __('booking.FULL_DAY', ['date' => $request->booking_date]);
            } elseif ($booking_type == 'half_day' && $request->booking_type == 'full_day') {
                $error = __('booking.HALF_FULL_DAY', ['date' => $request->booking_date]);
            } elseif ($request->booking_slot == $booking->booking_slot) {
                $error = __('booking.BOOKING_SLOT');
            }
        }
        return $error;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $booking = $this->booking->findOrFail($id);
            return view('booking.show', compact('booking'));
        } catch (Exception $e) {
            return rediect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $booking = $this->booking->findOrFail($id);
            return view('booking.create', compact('booking'));
        } catch (Exception $e) {
            return rediect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingPostRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $booking = $this->booking->where('id', $id)->first();
            $checkRule = $this->checkRule($request, $id);
            if ($checkRule != '') {
                return back()
                    ->withInput()
                    ->withErrors(['error', $checkRule]);
            }
            if ($booking) {
                $booking->update($request->only(['name', 'email', 'booking_type', 'booking_slot', 'booking_date', 'booking_time']));
            }
            DB::commit();
            return redirect()
                ->route('bookings.index')
                ->with('success', __('booking.BOOKING_UPDATE'));
        } catch (Exception $e) {
            DB::rollBack();
            return rediect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->booking->where('id', $id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Recourd deleted successfully',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return rediect()->back();
        }
    }
}
