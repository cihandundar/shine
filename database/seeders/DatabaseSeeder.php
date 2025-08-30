<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\admin\roles;
use App\Models\admin\permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default roles
        $adminRole = roles::create(['name' => 'Super Admin']);
        $editorRole = roles::create(['name' => 'Editor']);
        $authorRole = roles::create(['name' => 'Author']);
        $userRole = roles::create(['name' => 'User']);

        // Create permissions for admin role
        $adminPermissions = [
            'user_management',
            'role_management', 
            'blog_management',
            'system_settings'
        ];

        foreach ($adminPermissions as $permission) {
            permission::create([
                'name' => $permission,
                'role_id' => $adminRole->id
            ]);
        }

        // Create permissions for editor role
        $editorPermissions = [
            'blog_management',
            'content_editing'
        ];

        foreach ($editorPermissions as $permission) {
            permission::create([
                'name' => $permission,
                'role_id' => $editorRole->id
            ]);
        }

        // Create permissions for author role
        $authorPermissions = [
            'content_creation',
            'self_content_editing'
        ];

        foreach ($authorPermissions as $permission) {
            permission::create([
                'name' => $permission,
                'role_id' => $authorRole->id
            ]);
        }

        // Create test user with admin role
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id
        ]);

        // Create regular test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => $userRole->id
        ]);
    }
}
