<?php

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
        DB::table('users')->insert([
            'name' => 'Pedro',
            'email' => 'pedro@mail.com',
            'password' => bcrypt(123456789),
            'instituicao_id' => '1',
        ]);
    }
}
