<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AssetType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AccountSeeder::class,
            PermissionSeeder::class,
            PermissionRoleTableSeeder::class,
            // AssetType::class
        ]);
        \App\Models\User::factory(100)->create();
    }
}
