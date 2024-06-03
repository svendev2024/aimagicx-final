<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Exception;
use Illuminate\Http\Request;


class UpgradeController extends Controller
{   
    protected $api;

    public function __construct()
    {
        $this->api = new LicenseController();
    }

    /**
     * Dispaly activation index page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_version = $this->api->get_current_version();

        $latest_version = $this->api->check_update();

        return view('admin.settings.upgrade.index', compact('current_version', 'latest_version'));
    }


    /**
     * Start upgrade process
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upgrade(Request $request)
    {

        $current_version = $this->api->get_current_version();
        $latest_version = $this->api->get_latest_version();
        
        if ($current_version == $latest_version['latest_version']) {
            if ($request->ajax()) {
                return false;
            }

            toastr()->success(__('You are already using the latest version ') . $latest_version['latest_version']);
            return redirect()->back();
        }

        try {
            $response = $this->api->download_update($request->update_id, false, $request->version, $license = false, $client = false, $db_for_import = false);
        } catch(Exception $e) {
            toastr()->error(__('There was an error during software update. ') . $e->getMessage());
            return redirect()->back();
        }

        if ($response) {
            $this->storeConfiguration('APP_VERSION', $latest_version['latest_version']);

        }
		
		try {
                //Artisan::call('migrate', ['--force' => true]);
              //  Artisan::call('db:seed');
                Artisan::call('view:clear');
                Artisan::call('cache:clear');
                Artisan::call('config:clear');
                Log::info('Migration completed...');

		} catch (\Exception $e) {
			Log::info('Migration or Seed error: ' . $e->getMessage());
		}

        if ($request->ajax()) {
            return $response;
        }

        if ($response) {     
            toastr()->success(__('Software successfully was upgraded to version ') . $request->version);      
            return redirect()->back();
        } else {
            toastr()->error(__('Software was not updated correctly. Please try again or contact support'));
            return redirect()->back()->with('error', '');
        }
 
    }


    /**
     * Record in .env file
     */
    private function storeConfiguration($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));

        }
    }


    /**
     * Record in .env file
     */
    private function writeConfiguration($value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, $value, FILE_APPEND);

        }
    }


}
