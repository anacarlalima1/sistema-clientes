<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table = 'user';

    protected $fillable = [
        'nome',
        'nome_social',
        'cpf',
        'data_nasc',
        "foto",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        //        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function buscarClientes()
    {
        $users = DB::table('user')
            ->select('user.*')
            ->paginate(10);
        foreach ($users as $user) {
            $user->imagem = env('ADMIN_URL') . "/" . $user->imagem;
        }

        return $users;
    }
}
