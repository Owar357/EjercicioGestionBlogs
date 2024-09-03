<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tags = Tag::All();


            return $tags;
        } catch (\Exception $e) {
            return $e->getMessage();
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
            $tag = new Tag();

            $tag -> nombre = $request -> nombre;

            if($tag -> save())
            {
                return response()->json(['message' => 'Se creado con existo'], 201);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Hubo un error'. $e->getMessage()], 201);
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
