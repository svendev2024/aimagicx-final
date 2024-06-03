<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendors = [
            ['id' => 1, 'vendor_id' => 'azure_nrl', 'enabled' => 0, 'cost' => 0.000016],
            ['id' => 2, 'vendor_id' => 'gcp_nrl', 'enabled' => 0, 'cost' => 0.000016],
        ];

        foreach ($vendors as $vendor) {
            Vendor::updateOrCreate(['id' => $vendor['id']], $vendor);
        }
    }
}
