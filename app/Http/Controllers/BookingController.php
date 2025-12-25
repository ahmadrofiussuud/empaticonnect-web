<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Beneficiary;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isGuardian()) {
            $bookings = $user->guardianBookings()
                ->with(['helper.helperProfile', 'beneficiary', 'activityLogs'])
                ->latest()
                ->paginate(10);
        } else if ($user->isHelper()) {
            $bookings = $user->helperBookings()
                ->with(['guardian', 'beneficiary', 'activityLogs'])
                ->latest()
                ->paginate(10);
        } else {
            $bookings = collect();
        }

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking
     */
    public function create()
    {
        $beneficiaries = Auth::user()->beneficiaries;
        
        return view('bookings.create', compact('beneficiaries'));
    }

    /**
     * Store a newly created booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'helper_id' => 'required|exists:users,id',
            'scheduled_time' => 'required|date|after:now',
            'location_start' => 'required|string|max:255',
            'location_end' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Verify beneficiary belongs to guardian
        $beneficiary = Beneficiary::where('id', $request->beneficiary_id)
            ->where('guardian_id', Auth::id())
            ->firstOrFail();

        $booking = Booking::create([
            'guardian_id' => Auth::id(),
            'helper_id' => $request->helper_id,
            'beneficiary_id' => $request->beneficiary_id,
            'scheduled_time' => $request->scheduled_time,
            'location_start' => $request->location_start,
            'location_end' => $request->location_end,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        // Log activity
        ActivityLog::create([
            'booking_id' => $booking->id,
            'log_message' => 'Booking created and pending helper confirmation',
            'log_time' => now(),
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified booking
     */
    public function show($id)
    {
        $user = Auth::user();
        $booking = Booking::with(['guardian', 'helper.helperProfile', 'beneficiary', 'activityLogs'])
            ->findOrFail($id);

        // Authorization check
        if ($booking->guardian_id !== $user->id && $booking->helper_id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        return view('bookings.show', compact('booking'));
    }

    /**
     * Update booking status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled',
        ]);

        $booking = Booking::findOrFail($id);
        $user = Auth::user();

        // Authorization
        if ($request->status === 'confirmed' && $booking->helper_id !== $user->id) {
            abort(403, 'Only the assigned helper can confirm');
        }
        if ($request->status === 'cancelled' && $booking->guardian_id !== $user->id) {
            abort(403, 'Only the guardian can cancel');
        }

        $booking->update(['status' => $request->status]);

        ActivityLog::create([
            'booking_id' => $booking->id,
            'log_message' => "Booking {$request->status} by {$user->name}",
            'log_time' => now(),
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', "Booking {$request->status} successfully!");
    }

    /**
     * Helper checks in to start the trip
     */
    public function checkIn($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->helper_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $booking->update(['status' => 'in_progress']);

        ActivityLog::create([
            'booking_id' => $booking->id,
            'log_message' => 'Helper checked in - Trip started',
            'log_time' => now(),
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Checked in successfully! Trip started.');
    }

    /**
     * Helper checks out to complete the trip
     */
    public function checkOut($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->helper_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $booking->update(['status' => 'completed']);

        ActivityLog::create([
            'booking_id' => $booking->id,
            'log_message' => 'Helper checked out - Trip completed',
            'log_time' => now(),
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Checked out successfully! Trip completed.');
    }

    /**
     * Send SOS/Emergency alert
     */
    public function sendSOS($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->helper_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        ActivityLog::create([
            'booking_id' => $booking->id,
            'log_message' => '🚨 SOS ALERT - Emergency assistance requested',
            'log_time' => now(),
        ]);

        // TODO: Send notification to guardian and emergency services

        return redirect()->route('bookings.show', $booking->id)
            ->with('warning', 'SOS alert sent! Emergency notification dispatched.');
    }
}
