<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterPubliciteRequest;
use App\Http\Requests\UpdatePubliciteRequest;
use Exception;
use App\Models\Publicite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PubliciteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $publicites = Publicite::where('isvalide', 1);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des publicités',
                'publicites' => $publicites,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des publicités',
            ]);
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
    public function store(RegisterPubliciteRequest $request)
    {
        try {
            $pub = new Publicite();

            $pub->media = $this->storeImage($request->media);
            $pub->demande_id = $request->demande_id;
            $pub->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'pub enregistré',
                'bien' => $pub,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de l\'ajout du bien',
            ]);
        }
    }

    private function storeImage($image)
    {
        return $image->store('imagePub', 'public');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publicite $publicite)
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Publicité trouvée',
                'publicite' => $publicite,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 404,
                'status_message' => 'Publicité non trouvée',
            ]);
        }
    }

    public function invalidPub(Publicite $publicite)
    {
        try {
            $publicite->update([
                'isValide' => 0
            ]);
            $publicite->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Publicité marquée comme invalide avec succès',
                'publicite' => $publicite,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors du marquage de la publicité comme invalide',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publicite $publicite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePubliciteRequest $request, Publicite $publicite)
    {
        try {

            if ($request->hasFile('media')) {
                Storage::delete($publicite->media);
            }

            $publicite->update([
                'media' => $request->hasFile('media') ? $this->storeImage($request->file('media')) : $publicite->media,
                'demande_id' => $request->input('demande_id', $publicite->demande_id),
            ]);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Publicité mise à jour avec succès',
                'publicite' => $publicite,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publicite $publicite)
    {
        try {
            $publicite->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Publicité supprimée avec succès',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la suppression de la publicité',
            ]);
        }
    }
}
