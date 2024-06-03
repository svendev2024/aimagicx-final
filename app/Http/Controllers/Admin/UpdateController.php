<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    
    /**
     * Update the database with the new migrations
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDatabase()
    {
        $migrateDatabase = $this->migrateDatabase();
        if ($migrateDatabase !== true) {
            return back()->with('error', 'Failed to migrate the database. ' . $migrateDatabase);
        }

        toastr()->success(__('Database migrated successfully'));
        return redirect()->route('admin.dashboard');
    }

    /**
     * Migrate the database
     *
     * @return bool|string
     */
    private function migrateDatabase()
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
			Artisan::call('db:seed', ['--class'=> 'PaymentPlatformsSeeder']);
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
			//Artisan::call('storage:link');

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
