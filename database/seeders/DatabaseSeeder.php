<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\admin\Role;
use App\Models\admin\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'Super Admin']);
        $editorRole = Role::create(['name' => 'Editor']);
        $authorRole = Role::create(['name' => 'Author']);
        $userRole = Role::create(['name' => 'User']);

        // Create permissions for Super Admin
        Permission::create([
            'name' => 'manage_users',
            'role_id' => $adminRole->id
        ]);
        Permission::create([
            'name' => 'manage_roles',
            'role_id' => $adminRole->id
        ]);
        Permission::create([
            'name' => 'manage_posts',
            'role_id' => $adminRole->id
        ]);

        // Create permissions for Editor
        Permission::create([
            'name' => 'manage_posts',
            'role_id' => $editorRole->id
        ]);
        Permission::create([
            'name' => 'view_users',
            'role_id' => $editorRole->id
        ]);

        // Create permissions for Author
        Permission::create([
            'name' => 'create_posts',
            'role_id' => $authorRole->id
        ]);
        Permission::create([
            'name' => 'edit_own_posts',
            'role_id' => $authorRole->id
        ]);

        // Create permissions for User
        Permission::create([
            'name' => 'view_posts',
            'role_id' => $userRole->id
        ]);

        // Create test users
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@shine.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@shine.com',
            'password' => Hash::make('password'),
            'role_id' => $editorRole->id
        ]);

        User::create([
            'name' => 'Author User',
            'email' => 'author@shine.com',
            'password' => Hash::make('password'),
            'role_id' => $authorRole->id
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@shine.com',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id
        ]);
    }
}
