<?php

use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Privilegio::truncate();
        \App\Models\Privilegio::create(
            [
                'nome' => 'Super',
                'status' => 'Ativo'
            ]
        );

        \App\Models\Privilegio::create(
            [
                'nome' => 'Professor',
                'status' => 'Ativo'
            ]
        );

        \App\Models\Privilegio::create(
            [
                'nome' => 'Aluno',
                'status' => 'Ativo'
            ]
        );

    }
}
