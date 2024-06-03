<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advertisement;

class AdsenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            ['id' => 1, 'type' => 'adsense-header', 'code' => '', 'status' => false],
            ['id' => 2, 'type' => 'adsense-download-top-728x90', 'code' => '', 'status' => false],
            ['id' => 3, 'type' => 'adsense-download-bottom-728x90', 'code' => '', 'status' => false],
            ['id' => 4, 'type' => 'adsense-download-300x250', 'code' => '', 'status' => false],
            ['id' => 5, 'type' => 'adsense-frontend-features-728x90', 'code' => '', 'status' => false],
            ['id' => 6, 'type' => 'adsense-frontend-blogs-728x90', 'code' => '', 'status' => false],
        ];

        foreach ($ads as $ad) {
            Advertisement::updateOrCreate(['id' => $ad['id']], $ad);
        }
    }
}
