<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\HelperProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HelperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $helpers = [
            [
                'name' => 'Budi Susanto',
                'skill' => ['Tunarungu', 'Bahasa Isyarat'],
                'bio' => 'Berpengalaman mendampingi teman Tuli selama 5 tahun.',
            ],
            [
                'name' => 'Siti Aminah',
                'skill' => ['Tunarungu', 'Komunikasi Visual'],
                'bio' => 'Sabar dan telaten dalam berkomunikasi dengan penyandang tunarungu.',
            ],
            [
                'name' => 'Joko Widodo',
                'skill' => ['Kursi Roda', 'Mobilitas Fisik'],
                'bio' => 'Kuat fisik dan terbiasa membantu pengguna kursi roda di medan sulit.',
            ],
            [
                'name' => 'Rina Mulyani',
                'skill' => ['Kursi Roda', 'Perawatan Lansia'],
                'bio' => 'Ramah dan perhatian, berpengalaman dengan lansia pengguna kursi roda.',
            ],
            [
                'name' => 'Andi Pratama',
                'skill' => ['Lansia', 'Pasca Operasi'],
                'bio' => 'Siap membantu pemulihan pasca operasi dan pendampingan harian.',
            ],
        ];

        foreach ($helpers as $index => $data) {
            $email = 'helper_dummy_' . ($index + 1) . '@example.com';
            
            // Check if user exists to avoid duplicates if run multiple times
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => 'helper',
                    'phone_number' => '0899999000' . $index,
                ]
            );

            HelperProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'tier' => $index % 2 == 0 ? 'pro_care' : 'buddy',
                    'skills' => $data['skill'],
                    'is_verified' => true,
                    'hourly_rate' => 50000 + ($index * 10000),
                    'availability_status' => 'available',
                    'rating' => 4.5 + ($index * 0.1),
                ]
            );
        }
        
        $this->command->info('✅ 5 Dummy Helpers seeded successfully!');
    }
}
