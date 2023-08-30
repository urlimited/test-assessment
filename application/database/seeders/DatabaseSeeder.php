<?php

namespace Database\Seeders;

use App\Models\Url;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // We should not think about collisions here, since faker has unique keyword for the slug
        Url::factory()->count(22)->create();
    }
}
