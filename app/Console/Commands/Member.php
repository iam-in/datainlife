<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\User;
use Illuminate\Console\Command;

class Member extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Request user_id, group_id and add user in group. If user not active, then activate.';

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
        $user_id = $this->ask('Set user_id'); // запрос id пользователя
        $group_id = $this->ask('Set group_id'); // запрос id группы
        $user = User::with('groups')->find($user_id);
        $group = Group::with('users')->find($group_id);

        $allert = $this->confirm("Are you sure you want to add a user to the group?");

        // если пользователь не активен (active == false), активировать его (active = true)
        if (!$user->active) {
            $user->active = True;
            $user->save();
        }

        // добавим пользователя в группу
        $group->users()->syncWithoutDetaching($user);

        // заполним поле expired_at равное количеству часов expire_hours у группы
        $access_time = date("Y.m.d H:i:s", strtotime("+" . $group->expire_hourse . "hours", strtotime(now())));
        $group->users()->updateExistingPivot($user, array('expired_at' => $access_time));

        $this->info('Success!');

        return 0;
    }
}
