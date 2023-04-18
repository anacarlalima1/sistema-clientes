<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //visão professor
        $professor = \App\Models\User::select('id')->where('id_privilegio', 2)->count();
        $count = strval($professor + 1);

        \App\Models\User::create([
           'nome' => 'professor '.$count,
           'email' => 'professor'.$count.'@mvceditora.com.br',
            'matricula' => '123456789'.$count,
            'foto' => '/assets/images/sala-video.jpg',
            'id_privilegio' => 2,
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
        ]);

        //visão aluno

        $aluno = \App\Models\User::select('id')->where('id_privilegio', 3)->count();
        $count = strval($aluno + 1);

        \App\Models\User::create([
            'nome' => 'aluno '.$count,
            'email' => 'aluno'.$count.'@mvceditora.com.br',
            'matricula' => '12345678'.$count,
            'foto' => '/assets/images/sala-video.jpg',
            'id_privilegio' => 3,
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
        ]);

        //visão super admin

        $super = \App\Models\User::select('id')->where('id_privilegio', 1)->count();
        $count = strval($super + 1);

        if ($super == 0) {
            \App\Models\User::create([
                'nome' => 'super '.$count,
                'email' => 'super'.$count.'@mvceditora.com.br',
                'matricula' => '1234567'.$count,
                'foto' => '/assets/images/sala-video.jpg',
                'id_privilegio' => 1,
                'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            ]);
        }

    }
}
