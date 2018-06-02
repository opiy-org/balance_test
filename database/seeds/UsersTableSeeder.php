<?php

use App\Models\User;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $z = rand(15, 20);

        for ($i = 1; $i <= $z; $i++) {
            factory(User::class)->create();
        }
    }


}
