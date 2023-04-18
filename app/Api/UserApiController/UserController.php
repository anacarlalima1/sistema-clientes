<?php

namespace App\Api\UserApiController;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController
{
    public function updatePassword(Request $request)
    {
        $id = $request['id'];
        User::where('id', $id)
            ->update([
                'password' => bcrypt($request['password']),
            ]);

        return response()->json(['success' => true, 'message' => 'Ok']);
    }

    public function updatePersonal(Request $request)
    {
        $id = $request['id'];
        User::where('id', $id)
            ->update([
                'nome' => $request['name'],
                'email' => $request['email']
            ]);

        return response()->json(['success' => true, 'message' => 'Ok']);
    }

    public function getNotificacoes (Request $request)
    {
        try {
            $id_turma = $request['id_turma'];
            $notificacoes = DB::table('notificacoes')
                ->where('id_turma', $id_turma)
                ->get();

            return response()->json(['notificacao' => $notificacoes, 'success' => true], 500);
        }
        catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'success' => false], 500);
        }
    }
}
