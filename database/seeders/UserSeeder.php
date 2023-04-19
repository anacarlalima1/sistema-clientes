<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('user')->insert(
            [
                [
                    'nome'     => 'Alice Croft',
                    'nome_social'     => 'Croft',
                    'cpf'    => '12345678',
                    'data_nasc'    => '1995-03-02',
                ],
                [
                    'nome'     => 'Bruce Stay',
                    'nome_social'     => 'Stay',
                    'cpf'    => '123455678',
                    'data_nasc'    => '1995-03-02',
                ],
                [
                    'nome'     => 'Lara Hit',
                    'nome_social'     => 'Hit',
                    'cpf'    => '123045678',
                    'data_nasc'    => '1995-03-02',
                ],
                [
                    'nome'     => 'Maya Hit',
                    'nome_Social'     => 'Maya ',
                    'cpf'    => '12315678',
                    'data_nasc'    => '1995-03-02',
                ]
            ]
        );
    }


}
