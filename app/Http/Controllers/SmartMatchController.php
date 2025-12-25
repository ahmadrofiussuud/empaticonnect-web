<?php

namespace App\Http\Controllers;

use App\Models\HelperProfile;
use Illuminate\Http\Request;

class SmartMatchController extends Controller
{
    /**
     * Find helpers based on location, skills, and availability
     * Sorting: Tier (Pro Care first) then Rating
     */
    public function findHelpers(Request $request)
    {
        $request->validate([
            'required_skills' => 'nullable|array',
            'required_skills.*' => 'string',
            'location' => 'nullable|string',
        ]);

        $query = HelperProfile::with('user')
            ->verified()
            ->available();

        // Filter by skills if provided
        if ($request->has('required_skills') && !empty($request->required_skills)) {
            foreach ($request->required_skills as $skill) {
                $query->whereJsonContains('skills', $skill);
            }
        }

        // Sort by tier (pro_care first) then by rating
        $helpers = $query->byTier()
            ->byRating()
            ->paginate(12);

        if ($request->expectsJson()) {
            return response()->json($helpers);
        }

        return view('helpers.search', compact('helpers'));
    }

    /**
     * Show helper profile
     */
    public function show($id)
    {
        $helper = HelperProfile::with('user')->findOrFail($id);
        
        return view('helpers.show', compact('helper'));
    }
}
