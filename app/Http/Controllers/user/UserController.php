<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        try {
            return view('change-password');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $array = $request->all();
        $validationUpdate = $this->validationUpdate($array);
        if ($validationUpdate->fails()) {
            throw ValidationException::withMessages($validationUpdate->errors()->getMessages());
        }
        try {
            $id = Auth::id();
            $user = User::where('id', $id)->update([
                "password" => Hash::make($array['password']),
                "change_first" => 0
            ]);
            return redirect('/');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function validationUpdate($data)
    {
        return Validator::make($data, ["password" => "required|confirmed", "password_confirmation" => "required"], [
            "password.required" => "Campo obrigatório",
            "password.confirmed" => "Senhas não coincidem"
        ]);
    }
}
