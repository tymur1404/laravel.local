<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'author_uknow@g.g',
                'password' => bcrypt(Str::random(99999999)),
            ],
            [
                'name' => 'Автор ',
                'email' => 'author_1@g.g',
                'password' => bcrypt(Str::random(99999999)),
            ]
        ];

        DB::table('users')->insert($data);
    }
}
