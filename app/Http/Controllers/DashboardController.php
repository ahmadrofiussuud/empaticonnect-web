<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Guardian Dashboard
     */
    public function guardianDashboard()
    {
        $user = Auth::user();
        
        if (!$user->isGuardian()) {
            return redirect()->route('helper.dashboard');
        }

        $beneficiaries = $user->beneficiaries()->with('bookings')->get();
        $activeBookings = $user->guardianBookings()
            ->with(['helper.helperProfile', 'beneficiary', 'activityLogs'])
            ->active()
            ->latest()
            ->get();
        
        $recentActivities = \App\Models\ActivityLog::whereIn(
            'booking_id',
            $user->guardianBookings()->pluck('id')
        )->latest('log_time')->take(10)->get();

        return view('dashboard.guardian', compact('beneficiaries', 'activeBookings', 'recentActivities'));
    }

    /**
     * Helper Dashboard
     */
    public function helperDashboard()
    {
        $user = Auth::user();
        
        if (!$user->isHelper()) {
            return redirect()->route('dashboard');
        }

        $helperProfile = $user->helperProfile;
        
        $pendingBookings = $user->helperBookings()
            ->with(['guardian', 'beneficiary'])
            ->pending()
            ->latest()
            ->get();

        $activeBooking = $user->helperBookings()
            ->with(['guardian', 'beneficiary', 'activityLogs'])
            ->active()
            ->first();

        $completedCount = $user->helperBookings()->completed()->count();
        $totalEarnings = $user->helperBookings()
            ->completed()
            ->count() * ($helperProfile->hourly_rate ?? 0) * 2; // Estimate

        return view('dashboard.helper', compact(
            'helperProfile',
            'pendingBookings',
            'activeBooking',
            'completedCount',
            'totalEarnings'
        ));
    }

    /**
     * Admin Dashboard (future)
     */
    public function adminDashboard()
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            abort(403);
        }

        // Admin stats and management
        return view('dashboard.admin');
    }
}
