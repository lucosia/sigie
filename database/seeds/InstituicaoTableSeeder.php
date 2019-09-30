<?php

use Illuminate\Database\Seeder;

class InstituicaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instituicao')->insert([
            'nome' => 'Instituicao Padrao',
            'cnpj' => '00000000012345',
            'status' => 1,
        ]);
    }
}
