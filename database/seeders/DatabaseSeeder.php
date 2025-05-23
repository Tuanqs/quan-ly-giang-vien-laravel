<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gọi các seeder theo đúng thứ tự phụ thuộc
        $this->call([
            RoleSeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,       // UserSeeder cần RoleSeeder chạy trước
            LecturerSeeder::class,   // LecturerSeeder cần DepartmentSeeder (và UserSeeder nếu có liên kết user_id)
            // AcademicDegreeSeeder và WorkHistorySeeder đã được gọi bên trong LecturerSeeder qua factory.
        ]);

        // Ví dụ nếu bạn muốn tạo user thông qua factory (mặc định của Laravel)
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}