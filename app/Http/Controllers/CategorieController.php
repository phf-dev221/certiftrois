<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use Exception;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Liste des catégories',
            'categorie' => $categories
        ]);
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
    public function store(RegisterCategorieRequest $request)
    {
        $categorie = new Categorie();

        $categorie->nom = $request->nom;
        $categorie->save();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Categorie  enregistré',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        try {
            $categorie->update($request->only(['nom']));

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Informations categorie mise à jour avec succès',
                'categorie' => $categorie,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Information supprimée avec succès',
            'categorie' => $categorie,
        ]);
    }
}
