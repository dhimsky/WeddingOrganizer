<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        DB::table('users')->insert([
            'name' => 'Admin Gugugaga',
            'email' => 'admin@lumiere-wedding.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Profile
        DB::table('profiles')->insert([
            'company_name' => 'Gugugaga Wedding Organizer',
            'tagline' => 'Crafting Your Perfect Love Story',
            'description' => 'Gugugaga Wedding Organizer adalah tim profesional yang berdedikasi untuk menciptakan momen pernikahan impian Anda. Dengan pengalaman lebih dari 10 tahun, kami telah membantu ratusan pasangan mewujudkan hari istimewa mereka dengan sentuhan elegan dan penuh kenangan.',
            'founded_year' => '2013',
            'phone' => '+62 812-3456-7890',
            'email' => 'hello@lumiere-wedding.com',
            'address' => 'Jl. Sudirman No. 88, Jakarta Pusat, DKI Jakarta 10220',
            'instagram' => 'lumiere.wedding',
            'facebook' => 'LumiereWeddingID',
            'whatsapp' => '6281234567890',
            'tiktok' => '@lumiere.wedding',
            'youtube' => 'LumiereWeddingOrganizer',
            'events_done' => 350,
            'happy_couples' => 350,
            'team_members' => 25,
            'years_experience' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Vision & Mission
        DB::table('vision_missions')->insert([
            'vision' => 'Menjadi wedding organizer terpercaya dan terdepan di Indonesia yang menghadirkan pengalaman pernikahan tak terlupakan dengan sentuhan elegan, personal, dan penuh makna bagi setiap pasangan.',
            'mission' => json_encode([
                'Menghadirkan konsep pernikahan yang unik, personal, dan mencerminkan kepribadian setiap pasangan',
                'Memberikan pelayanan terbaik dengan standar profesionalisme tinggi dari awal hingga akhir acara',
                'Membangun jaringan vendor terpercaya untuk memastikan kualitas terbaik di setiap aspek pernikahan',
                'Menciptakan kenangan indah yang akan diingat seumur hidup oleh pasangan dan tamu undangan',
                'Terus berinovasi dalam tren dan konsep pernikahan modern tanpa meninggalkan nilai budaya lokal',
            ]),
            'values' => json_encode([
                ['title' => 'Elegance', 'icon' => '✨', 'description' => 'Setiap detail dirancang dengan keindahan dan keanggunan'],
                ['title' => 'Trust', 'icon' => '🤝', 'description' => 'Membangun kepercayaan melalui transparansi dan komitmen'],
                ['title' => 'Excellence', 'icon' => '⭐', 'description' => 'Standar tertinggi dalam setiap aspek pelayanan'],
                ['title' => 'Love', 'icon' => '💕', 'description' => 'Bekerja dengan sepenuh hati untuk momen terspesial'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Services
        $services = [
            ['name' => 'Full Wedding Organizer', 'slug' => 'full-wedding-organizer', 'icon' => '💍', 'is_featured' => true, 'price_start' => 25000000, 'price_end' => 150000000, 'short_description' => 'Layanan lengkap dari awal perencanaan hingga hari H', 'description' => 'Paket lengkap yang mencakup seluruh proses perencanaan dan pelaksanaan pernikahan Anda. Tim kami akan mendampingi Anda dari konsultasi pertama hingga momen terakhir di hari istimewa.', 'features' => json_encode(['Konsultasi unlimited', 'Perencanaan 6-12 bulan', 'Koordinasi vendor', 'Wedding day coordination', 'Dekorasi & floral', 'Catering management', 'Entertainment', 'Documentation'])],
            ['name' => 'Wedding Day Coordinator', 'slug' => 'wedding-day-coordinator', 'icon' => '📋', 'is_featured' => true, 'price_start' => 8000000, 'price_end' => 25000000, 'short_description' => 'Koordinasi profesional khusus di hari pernikahan', 'description' => 'Layanan koordinasi hari H yang memastikan seluruh rangkaian acara berjalan lancar dan sesuai rencana tanpa Anda perlu khawatir.', 'features' => json_encode(['Briefing H-1', 'Koordinasi vendor', 'Timeline management', 'Problem solving', 'Guest management', 'Family coordination'])],
            ['name' => 'Wedding Decoration', 'slug' => 'wedding-decoration', 'icon' => '🌸', 'is_featured' => true, 'price_start' => 15000000, 'price_end' => 80000000, 'short_description' => 'Dekorasi elegan yang mewujudkan konsep impian Anda', 'description' => 'Tim dekorator profesional kami akan menciptakan venue yang memukau sesuai dengan tema dan konsep pernikahan yang Anda impikan.', 'features' => json_encode(['Konsultasi desain', 'Floral arrangement', 'Lighting design', 'Backdrop ceremony', 'Table setting', 'Pelaminan'])],
            ['name' => 'Pre-Wedding Package', 'slug' => 'pre-wedding-package', 'icon' => '📸', 'is_featured' => false, 'price_start' => 5000000, 'price_end' => 30000000, 'short_description' => 'Abadikan momen indah sebelum hari pernikahan', 'description' => 'Paket foto dan video pre-wedding untuk mengabadikan momen romantic Anda sebelum hari istimewa tiba.', 'features' => json_encode(['Foto pre-wedding', 'Video cinematic', 'Location scouting', 'MUA profesional', 'Wardrobe styling', 'Album premium'])],
            ['name' => 'Intimate Wedding', 'slug' => 'intimate-wedding', 'icon' => '🕯️', 'is_featured' => false, 'price_start' => 10000000, 'price_end' => 40000000, 'short_description' => 'Pernikahan intim nan berkesan untuk momen pribadi', 'description' => 'Paket khusus untuk pernikahan skala kecil yang tetap elegan dan berkesan dengan sentuhan personal yang intim.', 'features' => json_encode(['Maksimal 100 tamu', 'Venue intimate', 'Dekorasi premium', 'Private catering', 'Documentation', 'Koordinasi penuh'])],
            ['name' => 'Destination Wedding', 'slug' => 'destination-wedding', 'icon' => '✈️', 'is_featured' => false, 'price_start' => 50000000, 'price_end' => 300000000, 'short_description' => 'Menikah di destinasi impian di seluruh Indonesia', 'description' => 'Wujudkan impian menikah di destinasi eksotis, dari Bali, Lombok, Raja Ampat hingga lokasi terbaik lainnya di seluruh Indonesia.', 'features' => json_encode(['Bali, Lombok, NTB', 'Vendor lokal terpercaya', 'Akomodasi guest', 'Legal documentation', 'Full coordination', 'Honeymoon package'])],
        ];

        foreach ($services as $i => $service) {
            DB::table('services')->insert(array_merge($service, [
                'is_active' => true, 'sort_order' => $i,
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Partners
        $partners = [
            ['name' => 'The Ritz-Carlton Jakarta', 'category' => 'Venue', 'description' => 'Hotel bintang lima mewah di jantung Jakarta'],
            ['name' => 'Mandarin Oriental', 'category' => 'Venue', 'description' => 'Venue iconic dengan pemandangan kota yang menakjubkan'],
            ['name' => 'Bali Catering Co.', 'category' => 'Catering', 'description' => 'Spesialis catering premium dengan cita rasa terbaik'],
            ['name' => 'Studio Aura Photography', 'category' => 'Photography', 'description' => 'Tim fotografer profesional berpengalaman'],
            ['name' => 'Blooms Florist Jakarta', 'category' => 'Florist', 'description' => 'Rangkaian bunga segar pilihan untuk dekorasi terbaik'],
            ['name' => 'Harmony Music Entertainment', 'category' => 'Entertainment', 'description' => 'Band dan entertainment profesional untuk wedding'],
            ['name' => 'Elegance Bridal', 'category' => 'Bridal', 'description' => 'Koleksi gaun pengantin eksklusif dan mewah'],
            ['name' => 'Cinematic Wedding Films', 'category' => 'Videography', 'description' => 'Videografi cinematic untuk mengabadikan momen terbaik'],
        ];

        foreach ($partners as $i => $partner) {
            DB::table('partners')->insert(array_merge($partner, [
                'logo' => 'partners/default.png', 'is_active' => true,
                'sort_order' => $i, 'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Gallery
        $galleries = [
            ['title' => 'Wedding Rania & Dimas', 'category' => 'Wedding', 'is_featured' => true, 'file_type' => 'image'],
            ['title' => 'Garden Party Sarah & Budi', 'category' => 'Wedding', 'is_featured' => true, 'file_type' => 'image'],
            ['title' => 'Intimate Wedding Dewi & Ari', 'category' => 'Intimate', 'is_featured' => true, 'file_type' => 'image'],
            ['title' => 'Bali Destination Wedding', 'category' => 'Destination', 'is_featured' => true, 'file_type' => 'image'],
            ['title' => 'Pre-Wedding Sinta & Joko', 'category' => 'Pre-Wedding', 'is_featured' => false, 'file_type' => 'image'],
            ['title' => 'Royal Ballroom Gala', 'category' => 'Wedding', 'is_featured' => true, 'file_type' => 'image'],
        ];

        foreach ($galleries as $i => $gallery) {
            DB::table('galleries')->insert(array_merge($gallery, [
                'description' => 'Dokumentasi pernikahan indah yang kami tangani',
                'file_path' => 'gallery/placeholder.jpg', 'is_active' => true,
                'sort_order' => $i, 'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Testimonials
        $testimonials = [
            ['couple_name' => 'Rania & Dimas', 'event_date' => 'Maret 2024', 'event_type' => 'Outdoor Garden', 'testimonial' => 'Gugugaga benar-benar mewujudkan impian kami. Tim mereka sangat profesional, detail-oriented, dan selalu ada saat kami membutuhkan. Hari pernikahan kami sempurna!', 'rating' => 5, 'is_featured' => true],
            ['couple_name' => 'Dewi & Ari', 'event_date' => 'Januari 2024', 'event_type' => 'Intimate Indoor', 'testimonial' => 'Terima kasih Gugugaga! Meskipun kami minta konsep intimate, hasilnya tetap sangat mewah dan berkesan. Tamu-tamu kami terkesan sekali dengan dekorasinya.', 'rating' => 5, 'is_featured' => true],
            ['couple_name' => 'Sarah & Budi', 'event_date' => 'Juni 2023', 'event_type' => 'Ballroom Wedding', 'testimonial' => 'Dari konsultasi pertama sampai hari H, semuanya berjalan mulus. Team Gugugaga sangat berpengalaman dan kreatif. Highly recommended!', 'rating' => 5, 'is_featured' => true],
            ['couple_name' => 'Putri & Rizki', 'event_date' => 'Agustus 2023', 'event_type' => 'Destination Bali', 'testimonial' => 'Menikah di Bali adalah impian kami, dan Gugugaga membuatnya menjadi kenyataan yang lebih indah dari yang kami bayangkan!', 'rating' => 5, 'is_featured' => false],
        ];

        foreach ($testimonials as $testimonial) {
            DB::table('testimonials')->insert(array_merge($testimonial, [
                'is_active' => true, 'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Settings
        $settings = [
            ['key' => 'site_title', 'value' => 'Gugugaga Wedding Organizer'],
            ['key' => 'meta_description', 'value' => 'Wedding organizer premium di Jakarta dengan pengalaman 10+ tahun'],
            ['key' => 'hero_tagline', 'value' => 'Crafting Your Perfect Love Story'],
            ['key' => 'primary_color', 'value' => '#C9A96E'],
            ['key' => 'maintenance_mode', 'value' => '0'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert(array_merge($setting, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Team Members
        $teamMembers = [
            ['name' => 'Andini Putri',   'role' => 'Founder & Lead Organizer'],
            ['name' => 'Rizky Pratama',  'role' => 'Creative Director'],
            ['name' => 'Siti Rahayu',    'role' => 'Wedding Coordinator'],
            ['name' => 'Budi Santoso',   'role' => 'Decoration Specialist'],
        ];

        foreach ($teamMembers as $i => $member) {
            DB::table('team_members')->insert(array_merge($member, [
                'is_active'  => true,
                'sort_order' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
