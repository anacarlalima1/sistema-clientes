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
        'matricula',
        'email',
        'password',
        "id_ano",
        "id_turma",
        "id_escola"
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

    public static function buscarAlunos($ids_escola, $ids_turma = null, $props = [])
    {
        if (isset($props['page'])) {
            $acao = 'paginate';
            $pages = $props['page'];
        } else {
            $acao = 'get';
            $pages = '';
        }
        $user = DB::table('user')
            ->where('user.status', 'Ativo')
            ->where('user.id_privilegio', 3)
            ->whereIn('user.id_escola', $ids_escola)
            ->where(function ($query) use ($ids_turma) {
                if ($ids_turma) {
                    $query->whereIn('user.id_turma', $ids_turma);
                }
            })
            ->orderBy('user.nome')
            ->orderBy('user.created_at', 'desc')
            ->select('user.id', 'user.nome', 'user.matricula', 'user.created_at', 'user.id_escola', 'user.id_turma', 'user.id_ano')
            ->$acao($pages);

        return $user;
    }
    public function findBy($request)
    {
        if (isset($request['paginas'])) {
            $acao = 'paginate';
            $pages = $request['paginas'];
        } else {
            $acao = 'get';
            $pages = '';
        }

        $selects = $request['selects'] ?? 'user.*';

        return DB::table('user')
            ->leftJoin('user_escola', 'user_escola.id_user', '=', 'user.id')
            ->leftJoin('escola', 'escola.id', '=', 'user.id_escola')
            ->leftJoin('user_turma', 'user_turma.id_user', '=', 'user.id')
            ->leftJoin('turma', 'turma.id', '=', 'user.id_turma')
            ->leftJoin('user_disciplina', 'user_disciplina.id_user', '=', 'user.id')
            ->leftJoin('ano', 'ano.id', '=', 'user.id_ano')
            ->leftJoin('user_ano', 'user_ano.id_user', '=', 'user.id')
            ->select($selects)
            ->where(function ($query) use ($request) {
                if (isset($request['status'])) {
                    $query->whereIn('user.status', $request['status']);
                } else {
                    $query->where('user.status', 'Ativo');
                }
            })
            ->where(function ($query) use ($request) {
                if(isset($request['privilegios'])){
                    if (in_array(3, $request['privilegios'])) {
                        $this->filtrandoCamposAluno($query, $request);
                    } else {
                        $this->filtrandoCamposProf($query, $request);
                    }
                }
            })
            ->where(function ($query) use ($request) {
                $this->filtrandoCampos($query, $request);
            })
            ->groupBy('user.id')
            ->$acao($pages);
    }

    private function filtrandoCamposAluno($query, $request)
    {
        if (isset($request['nome'])) {
            $query->where('user.nome', 'like', "%" . $request['nome'] . "%");
        }
        if (isset($request['turmas'])) {
            $query->whereIn('user.id_turma', $request['turmas']);
        }
        if (isset($request['escolas'])) {
            $query->whereIn('user.id_escola', $request['escolas']);
        }
        if (isset($request['anos'])) {
            $query->whereIn('user.id_ano', $request['anos']);
        }
    }

    private function filtrandoCamposProf($query, $request)
    {
        if (isset($request['nome'])) {
            $query->where('user.nome', 'like', "%" . $request['nome'] . "%");
        }
        if (isset($request['turmas'])) {
            $query->whereIn('user_turma.id_turma', $request['turmas']);
        }
        if (isset($request['escolas'])) {
            $query->whereIn('user_escola.id_escola', $request['escolas']);
        }
        if (isset($request['disciplinas'])) {
            $query->whereIn('user_disciplina.id_disciplina', $request['disciplinas']);
        }
        if (isset($request['anos'])) {
            $query->whereIn('user_ano.id_ano', $request['anos']);
        }
    }

    private function filtrandoCampos($query, $request)
    {
        if (isset($request['nome'])) {
            $query->where('user.nome', 'like', '%' . $request['nome'] . '%');
        }
        if (isset($request['privilegios'])) {
            $query->whereIn('user.id_privilegio', $request['privilegios']);
        }
        if (isset($request['situacao'])) {
            $query->where('user.change_first', $request['situacao']);
        }
        if (isset($request['ids'])) {
            $query->whereIn('user.id', $request['ids']);
        }
    }

    public function colocarDetalhes($usuarios, $props = [])
    {
        foreach ($usuarios as $usuario) {
            if (isset($usuario->foto)) {
                $usuario->foto = env('APP_URL') . '/' . $usuario->foto;
            }
            if (isset($usuario->created_at)) {
                $usuario->data_criacao = date('d/m/Y', strtotime($usuario->created_at));
            }
            if (isset($props['disciplinas'])) {
                $usuario->disciplinas = $this->buscarDisciplinas($usuario->id);
            }
            if (isset($props['anos'])) {
                $usuario->anos = $this->buscarAnos($usuario->id);
            }
            if (isset($props['escolas'])) {
                $usuario->escolas = $this->buscarEscolas($usuario->id);
            }
            if (isset($props['turmas'])) {
                $usuario->turmas = $this->buscarTurmas($usuario->id);
            }
        }

        return $usuarios;
    }

    public static function buscarDisciplinas($id_user)
    {

        $id_privilegio = User::where('id', $id_user)->first()->id_privilegio;

        if ($id_privilegio == 2) {
            $disciplinas = DB::table('user_disciplina')
                ->join('disciplina', 'disciplina.id', '=', 'user_disciplina.id_disciplina')
                ->where('user_disciplina.id_user', $id_user)
                ->where('disciplina.status', 'Ativo')
                ->select('disciplina.*', 'disciplina.nome as nome')
                ->get();
        } else {
            $disciplinas = DB::table('disciplina')
                ->where('disciplina.status', 'Ativo')
                ->select('disciplina.*')
                ->get();
        }

        return $disciplinas;
    }

    public static function buscarAnos($id_user)
    {
        $id_privilegio = User::where('id', $id_user)->first()->id_privilegio;

        if ($id_privilegio == 2) {
            return DB::table('user_ano')
                ->join('ano', 'ano.id', '=', 'user_ano.id_ano')
                ->where('user_ano.id_user', $id_user)
                ->where('ano.status', 'Ativo')
                ->select('ano.*', 'ano.nome as descricao')
                ->get();
        } else {
            return DB::table('ano')
                ->where('ano.status', 'Ativo')
                ->select('ano.*', 'ano.nome as descricao')
                ->get();
        }
    }

    public static function buscarEscolas($id_user)
    {
        return DB::table('user_escola')
            ->join('escola', 'escola.id', '=', 'user_escola.id_escola')
            ->where('user_escola.id_user', $id_user)
            //            ->where('escola.status', 'Ativo')
            ->select('escola.*')
            ->get();
    }

    public static function buscarTurmas($id_user)
    {
        $id_privilegio = User::where('id', $id_user)->first()->id_privilegio;

        if ($id_privilegio == 2) {
            return DB::table('user_turma')
                ->join('turma', 'turma.id', '=', 'user_turma.id_turma')
                ->where('user_turma.id_user', $id_user)
                ->where('turma.status', 'Ativo')
                ->select('turma.*', 'turma.descricao', 'turma.descricao as nome')
                ->get();
        } else {
            $ids_escolas = User::buscarEscolas(auth()->id())->pluck('id');
            return Escola::buscarTurmas($ids_escolas);
        }
    }

    public static function inserirTurmas($arrayTurmas)
    {
        return DB::table('user_turma')
            ->insert($arrayTurmas);
    }

    public static function inserirEscolas($arrayEscolas)
    {
        return DB::table('user_escola')
            ->insert($arrayEscolas);
    }

    public static function inserirAnos($arrayAnos)
    {
        return DB::table('user_ano')
            ->insert($arrayAnos);
    }

    public static function inserirDisciplinas($arrayDisciplinas)
    {
        return DB::table('user_disciplina')
            ->insert($arrayDisciplinas);
    }

    public static function excluirUserTurmas($id_user, $ids_turma)
    {
        DB::table('user_turma')
            ->where('user_turma.id_user', $id_user)
            ->whereIn('user_turma.id_turma', $ids_turma)
            ->delete();
    }
    public static function excluirUserEscolas($id_user, $ids_escola)
    {
        DB::table('user_escola')
            ->where('user_escola.id_user', $id_user)
            ->whereIn('user_escola.id_escola', $ids_escola)
            ->delete();
    }
    public static function excluirUserAnos($id_user, $ids_ano)
    {
        DB::table('user_ano')
            ->where('user_ano.id_user', $id_user)
            ->whereIn('user_ano.id_ano', $ids_ano)
            ->delete();
    }
    public static function excluirUserDisciplinas($id_user, $ids_disciplina)
    {
        DB::table('user_disciplina')
            ->where('user_disciplina.id_user', $id_user)
            ->whereIn('user_disciplina.id_disciplina', $ids_disciplina)
            ->delete();
    }
}
