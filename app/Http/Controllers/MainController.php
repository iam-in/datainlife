<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function users()
    {
        $users = User::all();

        return view('users', compact('users'));
    }

    public function groups()
    {
        $groups = Group::all();

        return view('groups', compact('groups'));
    }

    public function group($group_id)
    {
        $group = Group::with('users')->find($group_id);

        return view('group', compact('group'));
    }

    public function user($user_id)
    {
        $user = User::with('groups')->find($user_id);

        return view('user', compact('user'));
    }

    public function addUser(Group $group_id)
    {
        $users = User::all();

        return view('set-group', [
            'users' => $users,
            'group' => $group_id
        ]);
    }

    public function addUserForm(Request $request, $group_id)
    {
        $user = $request->input('user_id');
        $group = Group::find($group_id);
        $access_time = date("Y.m.d H:i:s", strtotime("+" . $group->expire_hourse . "hours", strtotime(now())));

        $group->users()->syncWithoutDetaching([$user => ['expired_at' => $access_time]]);

        return redirect()->route(
            'group',
            $group->id
        )->with(
            [
                'message' =>
                'Пользователь успешно добавлен в группу.',
            ]
        );
    }
}
