<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'user_code' => 'admin_001',
            'user_fullname' => 'Admin 1',
            'departement' => 'Administrator',
            'user_password' => Hash::make('admin1234'),
            'data_status' => 1,
        ]);
        \App\Models\User::create([
            'user_code' => 'admin_002',
            'user_fullname' => 'Admin 2',
            'departement' => 'Administrator',
            'user_password' => Hash::make('admin1234'),
            'data_status' => 0,
        ]);

        // Departement Teknologi Informasi
        \App\Models\User::create([
            'user_code' => 'user_001',
            'user_fullname' => 'Andi Andito',
            'departement' => 'Teknologi Informasi',
            'user_password' => Hash::make('12345678'),
            'data_status' => 1,
        ]);
        \App\Models\User::create([
            'user_code' => 'user_002',
            'user_fullname' => 'Budi Budiyanto',
            'departement' => 'Teknologi Informasi',
            'user_password' => Hash::make('12345678'),
            'data_status' => 0,
        ]);
        \App\Models\User::create([
            'user_code' => 'user_003',
            'user_fullname' => 'Caca Marica',
            'departement' => 'Teknologi Informasi',
            'user_password' => Hash::make('12345678'),
            'data_status' => 1,
        ]);

        // Departement Sumber Daya Manusia
        \App\Models\User::create([
            'user_code' => 'user_004',
            'user_fullname' => 'Dani Danilo',
            'departement' => 'Sumber Daya Manusia',
            'user_password' => Hash::make('12345678'),
            'data_status' => 1,
        ]);
        \App\Models\User::create([
            'user_code' => 'user_005',
            'user_fullname' => 'Eca ecaca',
            'departement' => 'Sumber Daya Manusia',
            'user_password' => Hash::make('12345678'),
            'data_status' => 1,
        ]);
        \App\Models\User::create([
            'user_code' => 'user_006',
            'user_fullname' => 'Ferdi Ferdianto',
            'departement' => 'Sumber Daya Manusia',
            'user_password' => Hash::make('12345678'),
            'data_status' => 1,
        ]);

        // Departement Keuangan
        \App\Models\User::create([
            'user_code' => 'user_007',
            'user_fullname' => 'Geri Gerinto',
            'departement' => 'Keuangan',
            'user_password' => Hash::make('12345678'),
            'data_status' => 1,
        ]);
        \App\Models\User::create([
            'user_code' => 'user_008',
            'user_fullname' => 'Helmi Halmido',
            'departement' => 'Keuangan',
            'user_password' => Hash::make('12345678'),
            'data_status' => 1,
        ]);
        \App\Models\User::create([
            'user_code' => 'user_009',
            'user_fullname' => 'Ina Inara',
            'departement' => 'Keuangan',
            'user_password' => Hash::make('12345678'),
            'data_status' => 1,
        ]);

        //  Data Aplikasi Social Media //
        \App\Models\apps::create([
            'app_code' => 'app_001',
            'app_name' => 'X',
            'app_group' => 'Social Media',
            'app_url' => 'https://twitter.com/?lang=id',
            'data_status' => 1,
        ]);
        \App\Models\apps::create([
            'app_code' => 'app_002',
            'app_name' => 'Instagram',
            'app_group' => 'Social Media',
            'app_url' => 'https://www.instagram.com/',
            'data_status' => 1,
        ]);
        \App\Models\apps::create([
            'app_code' => 'app_003',
            'app_name' => 'YouTube',
            'app_group' => 'Social Media',
            'app_url' => 'https://www.youtube.com/',
            'data_status' => 1,
        ]);

        // Data Aplikasi Artificial Intelligence //
        \App\Models\apps::create([
            'app_code' => 'app_004',
            'app_name' => 'ChatGPT',
            'app_group' => 'Artificial Intelligence',
            'app_url' => 'https://chatgpt.com/',
            'data_status' => 1,
        ]);
        \App\Models\apps::create([
            'app_code' => 'app_005',
            'app_name' => 'Gemini',
            'app_group' => 'Artificial Intelligence',
            'app_url' => 'https://gemini.google.com/',
            'data_status' => 1,
        ]);

        // Data Aplikasi Project Management //
        \App\Models\apps::create([
            'app_code' => 'app_006',
            'app_name' => 'Trello',
            'app_group' => 'Project Management',
            'app_url' => 'https://trello.com/',
            'data_status' => 1,
        ]);
        \App\Models\apps::create([
            'app_code' => 'app_007',
            'app_name' => 'OpenProject',
            'app_group' => 'Project Management',
            'app_url' => 'https://www.openproject.org/',
            'data_status' => 1,
        ]);

        // Data Map User App //
        \App\Models\map_users_apps::create([
            'app_id' => 1,
            'user_id' => 2,
            'data_status' => 1,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 2,
            'user_id' => 2,
            'data_status' => 1,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 3,
            'user_id' => 2,
            'data_status' => 1,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 4,
            'user_id' => 2,
            'data_status' => 0,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 5,
            'user_id' => 2,
            'data_status' => 0,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 6,
            'user_id' => 2,
            'data_status' => 1,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 7,
            'user_id' => 2,
            'data_status' => 1,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 1,
            'user_id' => 3,
            'data_status' => 1,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 2,
            'user_id' => 3,
            'data_status' => 1,
        ]);
        \App\Models\map_users_apps::create([
            'app_id' => 3,
            'user_id' => 3,
            'data_status' => 0,
        ]);
    }
}
