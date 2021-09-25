<?php

namespace App\Console\Commands;

use App\Mail\SendMessage;
use App\Models\Group;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check_expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exclude all users in group, whose time is up';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with('groups')->get();

        foreach ($users as $user) {
            $countGroups = count($user->groups) > 0 ? count($user->groups) : 0;

            if ($countGroups > 0) {
                foreach ($user->groups as $group) {
                    if (strtotime($group->pivot->expired_at) < strtotime(now())) {
                        $user->groups()->detach($group);
                        $countGroups = $countGroups - 1;
                        Mail::to($user->email)->send(new SendMessage($user->name, $group->name));
                    }
                }
            }
            if ($countGroups == 0) {
                $user->active = 0;
                $user->save();
            }
        }

        $this->info('Done!');

        return 0;
    }
}
