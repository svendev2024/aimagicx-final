<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Carbon\Carbon;

class ImageExpirationCheckTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkimage:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Control image expiration date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         # Get all images
         $images = Image::whereNotNull('expires_at')->get();
        
         foreach($images as $row) {

            $result = Carbon::createFromFormat('Y-m-d H:i:s', $row['expires_at'])->isPast();
 
             if ($result) {            
                
                switch ($row->storage) {
                    case 'local':
                        if (Storage::exists($row->image)) {
                            Storage::delete($row->image);
                        }
                        break;
                    case 'aws':
                        if (Storage::disk('s3')->exists($row->image_name)) {
                            Storage::disk('s3')->delete($row->image_name);
                        }
                        break;
                    case 'wasabi':
                        if (Storage::disk('wasabi')->exists($row->image_name)) {
                            Storage::disk('wasabi')->delete($row->image_name);
                        }
                        break;
                    default:
                        # code...
                        break;
                }
                
                $row->delete();
             
             } 
         }
    }
}
