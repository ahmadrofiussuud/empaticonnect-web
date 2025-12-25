<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Guardian User
        $guardian = User::create([
            'name' => 'Ahmad Guardian',
            'email' => 'guardian@test.com',
            'password' => bcrypt('password'),
            'role' => 'guardian',
            'phone_number' => '081234567890',
        ]);

        // Create Helper Users
        $helper1 = User::create([
            'name' => 'Sarah Helper',
            'email' => 'helper@test.com',
            'password' => bcrypt('password'),
            'role' => 'helper',
            'phone_number' => '081234567891',
        ]);

        $helper2 = User::create([
            'name' => 'Budi Pro Helper',
            'email' => 'helper2@test.com',
            'password' => bcrypt('password'),
            'role' => 'helper',
            'phone_number' => '081234567892',
        ]);

        // Create Admin User
        $admin = User::create([
            'name' => 'Admin EmpatiConnect',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone_number' => '081234567893',
        ]);

        // Create Helper Profiles
        \App\Models\HelperProfile::create([
            'user_id' => $helper1->id,
            'tier' => 'buddy',
            'skills' => ['companionship', 'mobility_assistance', 'basic_care'],
            'is_verified' => true,
            'hourly_rate' => 50000,
            'availability_status' => 'available',
            'rating' => 4.5,
        ]);

        \App\Models\HelperProfile::create([
            'user_id' => $helper2->id,
            'tier' => 'pro_care',
            'skills' => ['medical_care', 'mobility_assistance', 'therapy', 'emergency_response'],
            'is_verified' => true,
            'hourly_rate' => 150000,
            'availability_status' => 'available',
            'rating' => 4.9,
        ]);

        // Create Beneficiaries for Guardian
        $beneficiary1 = \App\Models\Beneficiary::create([
            'guardian_id' => $guardian->id,
            'name' => 'Ibu Siti',
            'disability_type' => 'Mobility Impairment (Wheelchair)',
            'emergency_contact' => '081234567894',
            'notes' => 'Memerlukan bantuan untuk mobilitas. Ramah dan kooperatif.',
        ]);

        $beneficiary2 = \App\Models\Beneficiary::create([
            'guardian_id' => $guardian->id,
            'name' => 'Pak Joko',
            'disability_type' => 'Visual Impairment',
            'emergency_contact' => '081234567895',
            'notes' => 'Tunanetra, memerlukan pendamping untuk aktivitas luar.',
        ]);

        $beneficiary3 = \App\Models\Beneficiary::create([
            'guardian_id' => $guardian->id,
            'name' => 'Ibu Aminah',
            'disability_type' => 'Hearing Impairment',
            'emergency_contact' => '081234567896',
            'notes' => 'Komunikasi dengan bahasa isyarat',
        ]);

        $beneficiary4 = \App\Models\Beneficiary::create([
            'guardian_id' => $guardian->id,
            'name' => 'Pak Budi',
            'disability_type' => 'Mobility Impairment',
            'emergency_contact' => '081234567897',
            'notes' => 'Bantuan berjalan dengan walker',
        ]);

        $beneficiary5 = \App\Models\Beneficiary::create([
            'guardian_id' => $guardian->id,
            'name' => 'Ibu Ratna',
            'disability_type' => 'Cognitive Impairment',
            'emergency_contact' => '081234567898',
            'notes' => 'Pendampingan dan pengawasan konstan',
        ]);

        // Create Sample Bookings
        $booking1 = \App\Models\Booking::create([
            'guardian_id' => $guardian->id,
            'helper_id' => $helper1->id,
            'beneficiary_id' => $beneficiary1->id,
            'scheduled_time' => now()->addDays(1)->setTime(9, 0),
            'status' => 'pending',
            'location_start' => 'Jl. Merdeka No. 123, Jakarta',
            'location_end' => 'RS. Bethesda, Jakarta Selatan',
            'notes' => 'Konsultasi dokter rutin',
        ]);

        $booking2 = \App\Models\Booking::create([
            'guardian_id' => $guardian->id,
            'helper_id' => $helper2->id,
            'beneficiary_id' => $beneficiary2->id,
            'scheduled_time' => now()->addDays(2)->setTime(14, 0),
            'status' => 'confirmed',
            'location_start' => 'Jl. Sudirman No. 45, Jakarta',
            'location_end' => 'Taman Mini Indonesia Indah',
            'notes' => 'Rekreasi sore',
        ]);

        // Create Activity Logs
        \App\Models\ActivityLog::create([
            'booking_id' => $booking1->id,
            'log_message' => 'Booking created and pending helper confirmation',
            'log_time' => now(),
        ]);

        \App\Models\ActivityLog::create([
            'booking_id' => $booking2->id,
            'log_message' => 'Booking confirmed by helper',
            'log_time' => now(),
        ]);

        $this->command->info('✅ Sample data created successfully!');
        $this->command->info('');
        $this->command->info('Login credentials:');
        $this->command->info('Guardian: guardian@test.com / password');
        $this->command->info('Helper: helper@test.com / password');
        $this->command->info('Admin: admin@test.com / password');
    }
}
