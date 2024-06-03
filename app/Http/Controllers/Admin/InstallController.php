<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Setting;

class InstallController extends Controller
{
    protected $api;

    public function __construct()
    {
        $this->api = new LicenseController();
    }


    /**
     * Display install index page
     *
     */
    public function index()
    {
        return view('install.index');
    }


    /**
     * Check if hosting platform meets requirements 
     *
     */
    public function requirements()
    {
        $requirements = config('install.extensions');

        $results = [];
        // Check the requirements
        foreach ($requirements as $type => $extensions) {
            if (strtolower($type) == 'php') {
                foreach ($requirements[$type] as $extensions) {
                    $results['extensions'][$type][$extensions] = true;

                    if (! extension_loaded($extensions)) {
                        $results['extensions'][$type][$extensions] = false;

                        $results['errors'] = true;
                    }
                }
            } elseif (strtolower($type) == 'apache') {
                foreach ($requirements[$type] as $extensions) {
                    // Check if the function exists
                    // Prevents from returning a false error
                    if (function_exists('apache_get_modules')) {
                        $results['extensions'][$type][$extensions] = true;

                        if (! in_array($extensions, apache_get_modules())) {
                            $results['extensions'][$type][$extensions] = false;

                            $results['errors'] = true;
                        }
                    }
                }
            }
        }

        // If the current php version doesn't meet the requirements
        if (version_compare(PHP_VERSION, config('install.php_version')) == -1) {
            $results['errors'] = true;
        }

        return view('install.requirements', compact('results'));
    }


    /**
     * Check if hosting platform has proper permissions for select folders/paths
     *
     */
    public function permissions()
    {
        $permissions = config('install.permissions');

        $results = [];
        foreach ($permissions as $type => $files) {
            foreach ($files as $file) {
                if (is_writable(base_path($file))) {
                    $results['permissions'][$type][$file] = true;
                } else {
                    $results['permissions'][$type][$file] = false;
                    $results['errors'] = true;
                }
            }
        }

        return view('install.permissions', compact('results'));
    }


    /**
     * Display database inputs
     *
     */
    public function database()
    {
        return view('install.database');
    }


    /**
     * Process activation feature
     *
     */
    public function activation()
    {
        $this->processDatabase();

        Artisan::call('migrate', ['--path' => '/database/migrations/session/2021_07_24_003854_create_sessions_table.php']);

        try {
            Artisan::call('storage:link');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Symlink() PHP function is disabled in your hosting enviroment, please enable it first before proceeding with actiovation');
        } 
        

        $this->storeConfiguration('SESSION_DRIVER', 'database');    

        return view('install.activation');
    }


    /**
     * Validate the database credentials, and write the .env config file
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDatabaseCredentials()
    {
        request()->validate([
            'hostname' => 'required',
            'port' => 'required',
            'database' => 'required',
            'user' => 'required',
        ]);

        try {
            $validateDatabase = $this->validateDatabaseCredentials();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Provided database user credentials do not have access to this database. ' . $e);
        }
        
        if ($validateDatabase !== true) {
            return redirect()->back()->with('error', __('Invalid database credentials. ' . $validateDatabase));
        }
        
        if ($validateDatabase == true) {
            $this->storeConfiguration('DB_HOST', request('hostname'));
            $this->storeConfiguration('DB_PORT', request('port'));
            $this->storeConfiguration('DB_DATABASE', request('database'));
            $this->storeConfiguration('DB_USERNAME', request('user'));
            $this->storeConfiguration('DB_PASSWORD', request('password'));            
        }
        
        return redirect()->route('install.activation');
    }


    /**
     * Activate user license
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateApplication(Request $request)
    {
        request()->validate([
            'license' => 'required|string',
            'username' => 'required|string',
        ]);

        $status = $this->api->activate_license(request('license'), request('username'));

        if ($status['status'] == true) {

            $createDefaultAdmin = $this->createDefaultAdmin();
            if ($createDefaultAdmin !== true) {
                return redirect()->back()->with('error', __('Failed to create the default admin. ' . $createDefaultAdmin));
            }

            $saveInstalledFile = $this->saveInstalledFile();
            if ($saveInstalledFile !== true) {
                return redirect()->back()->with('error', __('Failed to finalize the installation. ' . $saveInstalledFile));
            }

            $rows = ['license', 'username'];        
            foreach ($rows as $row) {
                Setting::where('name', $row)->update(['value' => $request->input($row)]);
            }

        } else {
            return redirect()->back()->with('error', 'There was an error while activating your application, please contact support team.');
        }

        $activated = $status['status'];

        return view('install.complete', compact('activated', 'createDefaultAdmin'));      
    }


    /**
     * Process database creation
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processDatabase()
    {
        try {
            $migrateDatabase = $this->migrateDatabase();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during migrating your database, please contact support or try installation again. ' . $e->getMessage());
        }
        
        if ($migrateDatabase !== true) {
            return back()->with('error', __('Failed to migrate the database. ' . $migrateDatabase));
        }

        $seedDatabase = $this->seedDatabase();
        if ($seedDatabase !== true) {
            return back()->with('error', __('Failed to seed the database. ' . $seedDatabase));
        }   
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

            return true;
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    /**
     * Seed the database
     *
     * @return bool|string
     */
    private function seedDatabase()
    {
        try {
            Artisan::call('db:seed');
			

            return true;
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    /**
     * Create the default admin user
     *
     * @return bool|string
     */
    private function createDefaultAdmin()
    {
        try {
            $user = new User;

            $user->name = 'Admin';
            $user->email = 'admin@example.com';
            $user->assignRole('admin');
            $user->status = 'active';
            $user->group = 'admin';
            $user->password = Hash::make('admin12345');
            $user->available_words = 1000000;
            $user->available_images = 10000;
            $user->available_chars = 1000000;
            $user->available_minutes = 10000;
            $user->email_verified_at = now();
            $user->referral_id = strtoupper(Str::random(15));
            $user->job_role = 'Administrator';
            $user->save();

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return true;
    }


    /**
     * Validate the database credentials
     *
     * @return bool|string
     */

    private function validateDatabaseCredentials()
    {
        $hostname = request('hostname');
        $database = request('database');
        $username = request('user');
        $password = request('password');

        // Create connection
        try {
            $conn= mysqli_connect($hostname,$username,$password,$database);

            if (!$conn) {
                return back()->with('error', mysqli_connect_error());
            }

            return true;

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    /**
     * Record in .env file
     */
    private function storeConfiguration($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            try {
                file_put_contents($path, str_replace(
                    $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
                ));
            } catch (\Exception $e) {
                return back()->with('error', 'PHP file_put_contents() function is disabled in your hosting, enable it first');
            }
           

        }
    }


    /**
     * Write the installed file
     *
     * @return bool|string
     */
    private function saveInstalledFile()
    {
        if (!file_exists(storage_path('installed'))) {
            try {
                file_put_contents(storage_path('installed'), '');
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        return true;
    }
}
