<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserList extends Command
{

    protected $signature = 'users';
    protected $description = 'Displays users and their balances';

    public function handle()
    {
        $users = User::orderBy('id')->get();
        $cnt = count($users);

        if (!$cnt) {
            echo 'No users yet...';
            exit;
        }

        echo '-------------------------------------------- userlist' . "\n";
        echo 'id' . "\t" . 'name' . "\t\t\t" . 'balance' . "\n";
        /** @var User $user */
        foreach ($users as $user) {
            echo $user->id . "\t"
                . $user->name . "\t\t\t"
                . $user->balance . "\n";
        }
        echo '--------------------------------------------- (' . $cnt . ")\n";
    }

}
