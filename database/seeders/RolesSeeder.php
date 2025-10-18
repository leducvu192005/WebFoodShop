<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Dùng cho Hash
use Spatie\Permission\Models\Role; // Dùng cho Role của Spatie
use App\Models\User; // Dùng cho Model User
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tạo 3 Vai trò (Roles)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // 2. Tạo Tài khoản Admin (để dễ dàng quản lý ban đầu)
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('ldv123'), // Đổi mật khẩu mạnh hơn khi triển khai thực tế
            ]
        );

        // 3. Gán Role Admin cho tài khoản Admin
        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }
        //
    }
}
