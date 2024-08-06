<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

/**
 * @OA\Info(
 *   title="My first API",
 *   version="1.0.0",
 *   contact={
 *     "email": "support@example.com"
 *   }
 * )
 */
class UsuarioController extends Controller
{

    // ------------- VIEWS ----------------
    public function index()
    {
        $staff = Usuario::all();

        $action_icons = [
            "icon:pencil | click:updateUser({id})",
            "icon:trash | color:red | click:deleteUser({id})",
        ];

        return view('welcome', compact('staff', 'action_icons'));
    }

    public function store()
    {
        return view('store');
    }

    public function edit($id)
    {
        $user = Usuario::findOrFail($id);
        $user->senha = decrypt($user->senha);

        return view('edit', compact('user'));
    }

    // ------------- API ----------------

    /**
     *  @OA\Delete(
     *      path="/delete/{id}",
     *      summary="Deleta usuario pelo id",
     *      description="Deleta usuario pelo id",
     *      tags={"Usuario"},
     *   @OA\Response(
     *     response=204,
     *     description="Deletado com sucesso"
     *   )
     *  )
     */
    public function delete($id)
    {
        $user = Usuario::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }

    /**
     *  @OA\Create(
     *      path="/create",
     *      summary="Cria usuario",
     *      description="Cria usuario",
     *      tags={"Usuario"},
     *   @OA\Response(
     *     response=201,
     *     description="Criado com sucesso"
     *   )
     *  )
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'senha' => 'required|string|min:8',
        ]);

        $usuario = new Usuario();
        $usuario->nome = $data['nome'];
        $usuario->email = $data['email'];
        $usuario->senha = encrypt($data['senha']);
        $usuario->save();

        return response()->json($usuario, 201);
    }

    /**
     *  @OA\Update(
     *      path="/update/{id}",
     *      summary="Atualiza um usuario",
     *      description="Atualiza um usuario",
     *      tags={"Usuario"},
     *   @OA\Response(
     *     response=200,
     *     description="Atualizado com sucesso"
     *   )
     *  )
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:usuarios, email, $request->id",
            'senha' => 'required|string|min:8',
        ]);

        $usuario = Usuario::findOrFail($request->id);
        $usuario->nome = $data['nome'];
        $usuario->email = $data['email'];
        $usuario->senha = encrypt($data['senha']);
        $usuario->save();

        return response()->json($usuario, 200);
    }
}
