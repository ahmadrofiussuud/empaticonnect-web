<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of beneficiaries
     */
    public function index()
    {
        $beneficiaries = Auth::user()->beneficiaries()->withCount('bookings')->get();
        
        return view('beneficiaries.index', compact('beneficiaries'));
    }

    /**
     * Show the form for creating a new beneficiary
     */
    public function create()
    {
        return view('beneficiaries.create');
    }

    /**
     * Store a newly created beneficiary
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'disability_type' => 'required|string|max:255',
            'emergency_contact' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $beneficiary = Beneficiary::create([
            'guardian_id' => Auth::id(),
            'name' => $request->name,
            'disability_type' => $request->disability_type,
            'emergency_contact' => $request->emergency_contact,
            'notes' => $request->notes,
        ]);

        return redirect()->route('beneficiaries.index')
            ->with('success', 'Beneficiary added successfully!');
    }

    /**
     * Display the specified beneficiary
     */
    public function show($id)
    {
        $beneficiary = Beneficiary::with('bookings.helper.helperProfile')
            ->where('guardian_id', Auth::id())
            ->findOrFail($id);

        return view('beneficiaries.show', compact('beneficiary'));
    }

    /**
     * Show the form for editing the specified beneficiary
     */
    public function edit($id)
    {
        $beneficiary = Beneficiary::where('guardian_id', Auth::id())->findOrFail($id);
        
        return view('beneficiaries.edit', compact('beneficiary'));
    }

    /**
     * Update the specified beneficiary
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'disability_type' => 'required|string|max:255',
            'emergency_contact' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $beneficiary = Beneficiary::where('guardian_id', Auth::id())->findOrFail($id);
        
        $beneficiary->update($request->only([
            'name',
            'disability_type',
            'emergency_contact',
            'notes',
        ]));

        return redirect()->route('beneficiaries.show', $id)
            ->with('success', 'Beneficiary updated successfully!');
    }

    /**
     * Remove the specified beneficiary
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::where('guardian_id', Auth::id())->findOrFail($id);
        
        $beneficiary->delete();

        return redirect()->route('beneficiaries.index')
            ->with('success', 'Beneficiary removed successfully!');
    }
}
