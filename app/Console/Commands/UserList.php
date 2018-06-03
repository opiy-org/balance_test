<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;

class UserList extends Command
{

    protected $signature = 'users';
    protected $description = 'Displays users and their balances';

    public function handle()
    {
        $users = User::orderBy('id')->get();
        $cnt = count($users);

        if (!$cnt) {
            $this->info( 'No users yet...');
            exit;
        }

        $table = new Table($this->output);
        $table->setHeaders([
            'id', 'name', 'balance'
        ]);


        /** @var User $user */
        foreach ($users as $user) {
            $table->addRow([
                $user->id,
                $user->name,
                $user->balance]);
        }

        $table->addRow(new TableSeparator());
        $table->addRow([new TableCell('Total users: ' . $cnt, ['colspan' => 3])]);
        $table->render();
    }

}
