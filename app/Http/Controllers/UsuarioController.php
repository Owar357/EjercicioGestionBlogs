<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $usuario = Usuario::All();
            return $usuario;
        } catch (QueryException $q) {
            return response()->json(['status' => 'fail' , 'message' => 'Ocurrio un error al intentar traer los datos']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $usuario = new Usuario();

            $usuario-> alias = $request -> alias;
            $usuario-> edad = $request -> edad;
            

            if($usuario -> save())
            {
               return response()->json(['status' => 'ok', 'data' => $usuario , 'message' => 'El usuario se a creado con exito'],201);
            }
            else
            {
                 return response()->json(['status' => 'fail', 'data' => $usuario, 'message' => 'Ocurrio un error al intentar crear el usuario' ],500);
            }
            
        } catch (QueryException $q) {
             return response()->json(['status' => 'error','message' => 'Ocurrio un error  al tratar de guardarse en la base de datos']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
