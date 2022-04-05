<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SiteInfo;
use App\Models\SubCategory;
use App\Models\User;
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
        User::factory(50)->create();
        SiteInfo::factory(1)->create();
        Category::factory(20)->create();
        SubCategory::factory(40)->create();
    }
}
