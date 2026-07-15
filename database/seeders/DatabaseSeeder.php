<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\WebService;
use App\Models\Order;
use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (Admin, Student, Client)
        $admin = User::create([
            'name' => 'Budi Hartanto',
            'email' => 'admin@budihartanto.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $student = User::create([
            'name' => 'Eko Susilo',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $client = User::create([
            'name' => 'PT. Sahabat Sejahtera (Hendra)',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // 2. Seed Real Portfolios
        // Web / Systems category
        $webPortfolios = [
            [
                'title' => 'Microsoft Dealreg',
                'category' => 'web',
                'platform' => 'Laravel',
                'tech_stack' => ['Laravel', 'PHP', 'TailwindCSS', 'MySQL'],
                'description' => 'Sistem registrasi deals korporasi yang digunakan untuk mengelola kemitraan dan prospek penjualan lisensi produk Microsoft.',
                'image_url' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=600&auto=format&fit=crop&q=60',
                'order_index' => 1,
            ],
            [
                'title' => 'Jagabhumi',
                'category' => 'web',
                'platform' => 'WordPress',
                'tech_stack' => ['WordPress', 'PHP', 'Gutenberg', 'MySQL'],
                'description' => 'Situs portal budaya dan informasi pariwisata terintegrasi dengan peta interaktif dan navigasi responsif.',
                'image_url' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=600&auto=format&fit=crop&q=60',
                'order_index' => 2,
            ],
            [
                'title' => 'SMA Islam Al-Azhar 19',
                'category' => 'web',
                'platform' => 'WordPress',
                'tech_stack' => ['WordPress', 'PHP', 'Elementor', 'MySQL'],
                'description' => 'Website profil resmi SMA Islam Al-Azhar 19 dengan integrasi portal pengumuman dan direktori guru/siswa.',
                'image_url' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&auto=format&fit=crop&q=60',
                'order_index' => 3,
            ],
            [
                'title' => 'EMS Primagama',
                'category' => 'web',
                'platform' => 'NodeJS + CodeIgniter',
                'tech_stack' => ['Node.js', 'Express', 'CodeIgniter', 'MySQL', 'Socket.io'],
                'description' => 'Education Management System komprehensif untuk Primagama, mencakup modul presensi real-time, rapor online, dan e-payment.',
                'image_url' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&auto=format&fit=crop&q=60',
                'order_index' => 4,
            ],
            [
                'title' => 'First Media Web Portal',
                'category' => 'web',
                'platform' => 'CodeIgniter',
                'tech_stack' => ['CodeIgniter', 'PHP', 'Bootstrap', 'PostgreSQL'],
                'description' => 'Pengembangan modul self-care pelanggan untuk cek tagihan, paket internet, dan laporan gangguan jaringan.',
                'image_url' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=600&auto=format&fit=crop&q=60',
                'order_index' => 5,
            ],
            [
                'title' => 'Sahabat Sejahtera Corporate Web',
                'category' => 'web',
                'platform' => 'CodeIgniter',
                'tech_stack' => ['CodeIgniter', 'PHP', 'MySQL', 'Bootstrap'],
                'description' => 'Platform katalog produk grosir dengan dashboard kelola stok sederhana dan pelacakan order pembelian.',
                'image_url' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&auto=format&fit=crop&q=60',
                'order_index' => 6,
            ],
        ];

        // Mobile apps category
        $mobilePortfolios = [
            [
                'title' => 'Glomart App',
                'category' => 'mobile',
                'platform' => 'React Native',
                'tech_stack' => ['React Native', 'Expo', 'Redux', 'Laravel API'],
                'description' => 'Aplikasi e-commerce kebutuhan sehari-hari yang cepat, terintegrasi dengan gerbang pembayaran dan peta kirim.',
                'image_url' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=600&auto=format&fit=crop&q=60',
                'order_index' => 7,
            ],
            [
                'title' => 'Express Glomart Delivery',
                'category' => 'mobile',
                'platform' => 'React Native',
                'tech_stack' => ['React Native', 'Geolocation', 'Firebase', 'Laravel API'],
                'description' => 'Aplikasi kurir khusus pelacakan kiriman belanjaan Glomart dengan notifikasi real-time dan tanda tangan digital.',
                'image_url' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=600&auto=format&fit=crop&q=60',
                'order_index' => 8,
            ],
            [
                'title' => 'Kayanya Negeriku',
                'category' => 'mobile',
                'platform' => 'Flutter',
                'tech_stack' => ['Flutter', 'Dart', 'Provider', 'NodeJS API'],
                'description' => 'Aplikasi pariwisata interaktif yang menampilkan kekayaan alam Nusantara disertai video 360 derajat dan modul travel guide.',
                'image_url' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=600&auto=format&fit=crop&q=60',
                'order_index' => 9,
            ],
            [
                'title' => 'PMB SMP Islam Al-Azhar 32 Padang',
                'category' => 'mobile',
                'platform' => 'AppInventor',
                'tech_stack' => ['AppInventor', 'Blocky', 'Google Sheets DB'],
                'description' => 'Aplikasi sederhana untuk pendaftaran siswa baru secara online dan pengumuman hasil seleksi masuk sekolah.',
                'image_url' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=600&auto=format&fit=crop&q=60',
                'order_index' => 10,
            ],
        ];

        foreach (array_merge($webPortfolios, $mobilePortfolios) as $port) {
            Portfolio::create($port);
        }

        // 3. Seed Web Services
        $serviceWeb = WebService::create([
            'package_name' => 'Custom Web Application Development',
            'features' => [
                'Arsitektur Backend Tangguh (Laravel / NodeJS)',
                'Integrasi API & Database Kecepatan Tinggi',
                'Desain UI/UX Custom & Responsive Mobile-First',
                'Keamanan Enkripsi SSL & Optimasi Kecepatan Pages',
                'Dashboard Admin Kelola Konten Lengkap'
            ],
            'base_price' => 15000000.00,
        ]);

        $serviceMobile = WebService::create([
            'package_name' => 'Mobile App Development (Android & iOS)',
            'features' => [
                'Codebase Tunggal Performa Native (Flutter / React Native)',
                'Publikasi ke Google Play Store & Apple App Store',
                'Fitur Real-time (Chatting, GPS, Geolocation Tracker)',
                'Push Notifications Terintegrasi Firebase',
                'Integrasi API Gateway & Keamanan Data Enkripsi'
            ],
            'base_price' => 25000000.00,
        ]);

        $serviceWordPress = WebService::create([
            'package_name' => 'WordPress Corporate & Company Profile',
            'features' => [
                'Instalasi Theme Premium & Kustomisasi Elementor Pro',
                'Halaman Dinamis (Home, About, Services, Blog, Contact)',
                'Setup Google Analytics & SEO Tagging Basic',
                'Integrasi WhatsApp Chat & Formulir Kontak',
                'Sistem Manajemen Mandiri yang Mudah Digunakan'
            ],
            'base_price' => 5000000.00,
        ]);

        // 4. Seed Programming Courses
        $course1 = Course::create([
            'title' => 'Laravel 13 Masterclass: Zero to Hero',
            'slug' => 'laravel-13-masterclass-zero-to-hero',
            'description' => 'Pelajari framework PHP paling revolusioner Laravel 13 dari dasar hingga mahir. Kursus ini membahas fitur-fitur baru Laravel 13, Eloquent ORM, Blade, Middleware, Routing, dan pembuatan REST API dengan praktek langsung membangun aplikasi web dunia nyata.',
            'price' => 750000.00,
            'thumbnail_url' => 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?w=600&auto=format&fit=crop&q=60',
        ]);

        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Pengenalan Laravel 13 & Instalasi Environment',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Pada modul pertama ini, kita akan mempelajari sejarah Laravel, keunggulan versi 13, cara setup web server lokal (seperti MAMP atau Laragon), dan menginstal Laravel 13 melalui composer.',
            'duration_minutes' => 15,
            'order_index' => 1,
        ]);

        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Routing, Controllers, dan Struktur Folder Laravel 13',
            'video_url' => 'https://www.w3schools.com/html/movie.mp4',
            'content' => 'Di modul kedua ini, kita akan mempelajari bagaimana rute didefinisikan, cara membuat Controllers menggunakan Artisan, serta memahami struktur direktori utama Laravel 13.',
            'duration_minutes' => 25,
            'order_index' => 2,
        ]);

        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Eloquent ORM, Migrasi Database, dan Seeders',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Bagaimana Laravel berinteraksi dengan database? Kita akan membedah migrasi database, model relasi, attributes baru Laravel 13, serta cara membuat data dummy dengan seeders.',
            'duration_minutes' => 35,
            'order_index' => 3,
        ]);

        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Blade Templating Engine & Tailwind CSS v4 Integration',
            'video_url' => 'https://www.w3schools.com/html/movie.mp4',
            'content' => 'Desain frontend aplikasi Laravel dengan memadukan Blade Templating (layouts, sections, components) dengan framework CSS modern Tailwind CSS v4.',
            'duration_minutes' => 20,
            'order_index' => 4,
        ]);

        $course2 = Course::create([
            'title' => 'Flutter Mobile Development: Android & iOS',
            'slug' => 'flutter-mobile-development-android-ios',
            'description' => 'Membangun aplikasi mobile profesional berskala global menggunakan satu codebase dengan Flutter dan Dart. Kuasai State Management, UI Designing, API Connection, hingga publish aplikasi ke Google Play Store dan Apple App Store.',
            'price' => 950000.00,
            'thumbnail_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=600&auto=format&fit=crop&q=60',
        ]);

        Lesson::create([
            'course_id' => $course2->id,
            'title' => 'Setup Flutter SDK & Konfigurasi Emulator',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Pelajari cara mengunduh Flutter SDK, konfigurasi PATH sistem operasi, serta setup emulator Android Studio dan simulator Xcode di Mac.',
            'duration_minutes' => 20,
            'order_index' => 1,
        ]);

        Lesson::create([
            'course_id' => $course2->id,
            'title' => 'Memahami Konsep Widgets: Stateless & Stateful',
            'video_url' => 'https://www.w3schools.com/html/movie.mp4',
            'content' => 'Di Flutter, semuanya adalah Widget. Kita akan membedah secara mendalam siklus hidup (lifecycle) dari Stateless dan Stateful Widgets dan cara merender layout.',
            'duration_minutes' => 30,
            'order_index' => 2,
        ]);

        Lesson::create([
            'course_id' => $course2->id,
            'title' => 'State Management: Provider & Riverpod',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Meningkatkan kompleksitas aplikasi memerlukan manajemen status yang efisien. Modul ini mengajarkan konsep reactive programming menggunakan Provider dan alternatif modern Riverpod.',
            'duration_minutes' => 40,
            'order_index' => 3,
        ]);

        $course3 = Course::create([
            'title' => 'Full-Stack Web Development: Node.js & React',
            'slug' => 'full-stack-web-development-node-react',
            'description' => 'Kuasai pemrograman Javascript end-to-end. Anda akan diajarkan cara membuat REST API yang aman dengan Express & NodeJS, mendesain interface interaktif dengan ReactJS Hooks, serta menggunakan MongoDB sebagai media penyimpanan database NoSQL.',
            'price' => 1200000.00,
            'thumbnail_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&auto=format&fit=crop&q=60',
        ]);

        Lesson::create([
            'course_id' => $course3->id,
            'title' => 'Memulai Server Express dan Routing Dasar',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Setup project NodeJS pertama Anda, menginstal Express, mendengarkan port koneksi, dan mendefinisikan rute HTTP GET/POST/PUT/DELETE.',
            'duration_minutes' => 18,
            'order_index' => 1,
        ]);

        Lesson::create([
            'course_id' => $course3->id,
            'title' => 'React Components, Props, & State Hooks',
            'video_url' => 'https://www.w3schools.com/html/movie.mp4',
            'content' => 'Mengapa menggunakan React? Kita akan membuat struktur component, melewatkan data melalui properties, dan mengelola local state menggunakan useState dan useEffect.',
            'duration_minutes' => 28,
            'order_index' => 2,
        ]);

        Lesson::create([
            'course_id' => $course3->id,
            'title' => 'Integrasi JWT Auth & Database MongoDB',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
            'content' => 'Modul mahir untuk mengamankan API endpoint menggunakan JSON Web Token (JWT) dan menghubungkan Express Server ke klaster database MongoDB Cloud.',
            'duration_minutes' => 38,
            'order_index' => 3,
        ]);

        // 5. Seed Client Orders
        Order::create([
            'user_id' => $client->id,
            'web_services_id' => $serviceWeb->id,
            'invoice_number' => 'INV/20260715/WEB/' . strtoupper(Str::random(6)),
            'total_amount' => $serviceWeb->base_price,
            'payment_status' => 'paid',
            'project_status' => 'developing',
        ]);

        Order::create([
            'user_id' => $client->id,
            'web_services_id' => $serviceMobile->id,
            'invoice_number' => 'INV/20260715/MOB/' . strtoupper(Str::random(6)),
            'total_amount' => $serviceMobile->base_price,
            'payment_status' => 'pending',
            'project_status' => 'designing',
        ]);
    }
}
