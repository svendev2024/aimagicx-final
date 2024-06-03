<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscriber;
use App\Models\User;
use Carbon\Carbon;

class SubscriptionCheckTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscription statuses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check subscription status, block the ones that missed payments.
     *
     * @return int
     */
    public function handle()
    {
        # Get all active subscriptions
        $subscriptions = Subscriber::where('status', 'Active')->get();
        
        foreach($subscriptions as $row) {

            # Give extra 2 days to make a payment, otherwise suspend subscription
            # and move the user to free tier
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $row->active_until);
            $date = $date->addDays(3);

            $result = Carbon::createFromFormat('Y-m-d H:i:s', $date)->isPast();

            if ($result) {            
                $row->update([
                    'status'=>'Expired'
                ]);

                $user = User::where('id', $row->user_id)->firstOrFail();

                if ($user) {
                    $group = ($user->hasRole('admin'))? 'admin' : 'user';

                    $user->syncRoles($group);    
                    $user->group = $group;
                    $user->plan_id = null;
                    $user->total_words = 0;
                    $user->total_images = 0;
                    $user->total_chars = 0;
                    $user->total_minutes = 0;
                    $user->save();
                }
                            
            }
        }
    }
}
