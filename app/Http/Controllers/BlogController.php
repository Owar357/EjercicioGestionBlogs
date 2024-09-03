<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      try {
        $blogs = Blog::with('usuario', 'blogtag.tag')->get();
        return $blogs;
      } catch (\Exception $e) {
         return $e ->getMessage();
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
        DB::beginTransaction();
        $errores = 0;
        $blog = new Blog();
        $blog->titulo = $request -> titulo;
        $blog->contenido = $request -> contenido;
        $blog->usuario_id = $request->usuario['id'];       
        if($blog->save()<= 0)
        {
           $errores++;
        }
        //* INSERTAMOS LOS DATOS EN TAGS
            $bt = $request -> blogtag;
            foreach($bt  as $a => $i)
            {
              $blogtag = new BlogTag();  
              $blogtag-> tag_id = $i['tag']['id'];
              $blogtag-> blog_id = $blog -> id; 

              if($blogtag -> save()<=0 )
              {
                $errores++;   
              }
            }
           
            if($errores == 0)
            {
                DB::commit();
                return response()->json(['status' => 'ok', 'data' => $blog ,'message' => 'blog creado'],201);
            }
            else{
                DB::rollBack();
                return response()->json(['status' => 'fail', 'data' => null,'message' => 'Ocurrio un error al crear el blog'],409);
            }

       } catch (QueryException $q) {
          DB::rollBack();
          return response()->json(['status' => 'ERROR','message' => 'Error la base de datos:'. $q->getMessage()]);
       }
      
    }
    
public function buscartag(Request $request)
{
    $nombres = $request->input('nombres');

    // Verifica que $nombres sea un array
    if (is_string($nombres)) {
        $nombres = explode(',', $nombres);
    }

    // Paso 1: Obtener los IDs de los tags basados en los nombres
    $tagIds = Tag::whereIn('nombre', $nombres)->pluck('id');

    // Verifica que $tagIds sea un array
    if (!is_array($tagIds)) {
        $tagIds = $tagIds->toArray();
    }

    // Paso 2: Filtrar los blogs basados en los IDs de los tags
    $blogs = Blog::whereHas('tags', function ($query) use ($tagIds) {
        $query->whereIn('tags.id', $tagIds);
    })->get();

    return response()->json($blogs);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function buscadorTags()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        try {
        $blog = Blog::findOrFail($id);

        $blog-> titulo = $request -> titulo;
        $blog-> contenido = $request -> contenido;
        $blog-> tags = $request -> tags;
        $blog->usuario_id = $request -> usuario_id;

        if($blog -> update())
        {
            return response()->json(['status' => 'ok', 'data' => $blog , 'response' => 'Se actualizado el blog o Pagina'], 200);
        }
        } catch (QueryException $q) {
            return response()->json(['status' => 'error', 'data' => $blog , 'response' => 'Ocurrio un error al tratar de actualizar el blog o pagina'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $blog = Blog::findOrFail($id);
        
        if($blog -> delete())
        {
           return response()->json(['message' => 'Se elimino con exito'],200);
        }
        else
        {
             return response()->json(['message' => 'EL blog o pagina que trata de eliminarn no existe'], 200);
        }

        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'message' => 'Ocurrio un error en la base de datos']);
  
        }
    }
}
