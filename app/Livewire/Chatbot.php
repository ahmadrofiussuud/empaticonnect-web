<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HelperProfile;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\Auth;

class Chatbot extends Component
{
    public $step = 1;
    
    // Selections
    public $selected_beneficiary_id;
    public $selected_condition_text = ''; // e.g. 'Mobility Support'
    public $selected_time;
    
    // Data
    public $beneficiaries = [];

    public function mount()
    {
        // Load beneficiaries for the current user
        $this->beneficiaries = Auth::user()->beneficiaries ?? [];
        
        // If no beneficiaries, we might want to show empty state or redirect
        if (count($this->beneficiaries) == 0) {
            // For demo purposes, if no beneficiaries, we might rely on the seeder data
            // But let's assume the user has run the seeder or has data.
        }
    }

    public function selectBeneficiary($id, $condition)
    {
        $this->selected_beneficiary_id = $id;
        $this->selected_condition_text = $condition; // This maps to 'skills' search later
    }

    public function confirmBeneficiary()
    {
        if ($this->selected_beneficiary_id) {
            $this->step = 2;
        }
    }

    public function selectTime($time)
    {
        $this->selected_time = $time;
        $this->step = 3;
    }

    public function resetWizard()
    {
        $this->reset(['step', 'selected_beneficiary_id', 'selected_condition_text', 'selected_time']);
        $this->mount();
    }

    public function render()
    {
        $helpers = [];
        
        if ($this->step === 3) {
            // Mapping condition text to skills for search
            // Simple mapping for now
            $searchSkill = '';
            if (str_contains(strtolower($this->selected_condition_text), 'mobility')) {
                $searchSkill = 'Kursi Roda'; 
            } elseif (str_contains(strtolower($this->selected_condition_text), 'visual')) {
                $searchSkill = 'Tunanetra';
            } elseif (str_contains(strtolower($this->selected_condition_text), 'hearing')) {
                $searchSkill = 'Tunarungu';
            } else {
                 $searchSkill = 'Lansia';
            }

            // Fallback: If condition text is empty, search all
            if ($searchSkill) {
                // We use LIKE or JSON contains depending on implementation
                // Since we used exact matches in previous step, let's try to match flexible
                $helpers = HelperProfile::with('user')
                    ->where('skills', 'like', '%' . $searchSkill . '%')
                    ->orWhere('skills', 'like', '%' . $this->selected_condition_text . '%')
                    ->get();
            } else {
                $helpers = HelperProfile::with('user')->get();
            }
        }

        return view('livewire.chatbot', [
            'helpers' => $helpers
        ])->layout('layouts.dashboard'); 
    }
}
