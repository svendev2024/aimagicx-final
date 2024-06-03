<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use League\Flysystem\Adapter\Local;
use Illuminate\Support\Facades\Storage;
use Artisan;
use Exception;
use Log;

class BackupController extends Controller
{
    /**
     * Display all backups
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];

        foreach ($files as $k => $f) {

            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                    'disk' => $disk,
                ];
            }
        }

        $backups = array_reverse($backups);

        return view('admin.settings.backup.index', compact('backups'));
    }


    /**
     * Create a new backup
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            Artisan::call('backup:run', ['--only-db' => true, '--disable-notifications' => true]);

            toastr()->success(__('New DB backup was created successfully'));
            return redirect()->back();

        } catch (Exception $e) {
            toastr()->error(__('There was an error during backup creation'));
            return redirect()->back();
        }
    }


    /**
     * Download a backup file
     *
     * @return \Illuminate\Http\Response
     */
    public function download($file_name)
    {

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $file_name = config('backup.backup.name') . '/' . $file_name;

        if ($disk->exists($file_name)) {
            return Storage::download('backup/' .$file_name);
        } else {
            abort(404);
        }
    }


    /**
     * Delete backup file 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            
            $disk->delete(config('backup.backup.name') . '/' . $file_name);

            toastr()->success(__('DB backup was successfully deleted'));
            return redirect()->back();

        } else {
            abort(404);
        }
    }
}
