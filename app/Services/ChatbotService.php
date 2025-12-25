<?php

namespace App\Services;

use App\Models\User;
use App\Models\HelperProfile;
use Illuminate\Support\Str;

class ChatbotService
{
    /**
     * Analyze the user's message and determine the intent.
     */
    public function analyzeIntent(string $message): string
    {
        $message = strtolower($message);

        // Regex patterns for Intent Matching
        $patterns = [
            'greeting' => '/\b(halo|hi|hai|selamat|pagi|siang|sore|malam)\b/i',
            'search_helper' => '/\b(cari|butuh|perlu|rekomendasi|lihat|daftar)\s*(pendamping|helper|perawat|caregiver|suster|orang)\b/i',
            'status_order' => '/\b(status|cek|lacak)\s*(order|pesanan|booking)\b/i',
            'farewell' => '/\b(dah|dadah|bye|terima kasih|makasih)\b/i',
            'human' => '/\b(orang asli|admin|cs|customer service)\b/i',
        ];

        foreach ($patterns as $intent => $pattern) {
            if (preg_match($pattern, $message)) {
                return $intent;
            }
        }

        return 'default';
        // Fallback checks for keywords if regex fails (simpler matching)
        if (Str::contains($message, ['harga', 'biaya', 'tarif'])) {
            return 'pricing';
        }
    }

    /**
     * Get the appropriate response based on intent.
     */
    public function getResponse(string $intent, string $message): array
    {
        switch ($intent) {
            case 'greeting':
                return [
                    'text' => 'Halo! Selamat datang di EmpatiConnect. Saya asisten virtual Anda. Ada yang bisa saya bantu? Anda bisa meminta saya untuk mencarikan pendamping atau cek status booking.',
                    'type' => 'text'
                ];

            case 'search_helper':
                return $this->getHelperRecommendations($message);

            case 'status_order':
                return [
                    'text' => 'Untuk mengecek status booking, silakan buka menu "My Journey" di dashboard Anda. Di sana Anda dapat melihat semua riwayat dan status perjalanan aktif.',
                    'type' => 'text'
                ];
            
            case 'pricing':
                return [
                    'text' => 'Harga layanan kami bervariasi tergantung Helper. Rata-rata mulai dari Rp 50.000/jam. Silakan cari Helper untuk melihat tarif spesifik mereka.',
                    'type' => 'text'
                ];

            case 'human':
                return [
                    'text' => 'Saya mengerti Anda ingin berbicara dengan admin. Silakan hubungi nomor WhatsApp darurat kami di kontak yang tertera di footer halaman.',
                    'type' => 'text'
                ];

            case 'farewell':
                return [
                    'text' => 'Sama-sama! Senang bisa membantu. Jaga kesehatan ya!',
                    'type' => 'text'
                ];

            default:
                return [
                    'text' => 'Maaf, saya kurang mengerti. Coba ketik "Cari pendamping" atau "Cek status".',
                    'type' => 'text'
                ];
        }
    }

    /**
     * Logic to search for helpers in database.
     */
    private function getHelperRecommendations(string $message): array
    {
        // Simple extraction: try to find a specific role or skill mentioned (not strictly implemented yet, just getting top rated for now)
        
        // Fetch Top 3 Available Helpers
        $helpers = User::where('role', 'helper')
            ->whereHas('helperProfile', function($q) {
                $q->where('availability_status', 'available');
            })
            ->with(['helperProfile'])
            ->limit(3)
            ->get();

        if ($helpers->isEmpty()) {
            return [
                'text' => 'Maaf, saat ini belum ada Helper yang tersedia yang sesuai kriteria.',
                'type' => 'text'
            ];
        }

        $cards = $helpers->map(function($helper) {
            return [
                'id' => $helper->id,
                'name' => $helper->name,
                'image' => "https://ui-avatars.com/api/?name=" . urlencode($helper->name) . "&background=random",
                'rate' => 'Rp ' . number_format($helper->helperProfile->hourly_rate ?? 0, 0, ',', '.'),
                'rating' => $helper->helperProfile->rating ?? 0,
                'tier' => $helper->helperProfile->tier ?? 'Basic',
                'url' => route('bookings.create', ['helper_id' => $helper->id]) // Assuming direct link to book
            ];
        });

        return [
            'text' => 'Berikut adalah beberapa pendamping (Helper) terbaik kami yang tersedia untuk Anda:',
            'type' => 'cards',
            'data' => $cards
        ];
    }
}
