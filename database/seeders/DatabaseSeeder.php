<?php

namespace Database\Seeders;

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
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            AdsenseSeeder::class,
            CategorySeeder::class,
            PaymentPlatformsSeeder::class,
            LanguagesSeeder::class,
            TemplateSeeder::class,
            VoiceoverLanguagesSeeder::class,
            VoicesSeeder::class,
            VendorsSeeder::class,
            ChatsSeeder::class,
        ]);
    }
}
