<?php

namespace App\Http\Controllers;

use App\Http\Resources\BienRessource;
use Exception;
use App\Models\Bien;
use App\Models\User;
use App\Models\Image;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBienRequest;
use App\Http\Requests\RegisterBienRequest;
use Symfony\Component\HttpFoundation\JsonResponse;


class BienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Categorie $categorie)
    {
        try {
            $biens = Bien::with(["images", 'categorie', 'user'])->where('statut', 'en attente')
                ->where('categorie_id', $categorie->id)
                ->where('estExpire', 0)
                ->where('type_bien', 'bien trouve')
                ->get();

            return response()->json([
                'success' => true,
                'status_body' => 'Biens trouvés acceptés',
                'data' => BienRessource::collection($biens),
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des biens trouvés',
            ]);
        }
    }

    public function listeBiensTousType()
    {
        try {
            $biens = Bien::with(["images", 'categorie', 'user'])->where('statut', 'en attente')
                ->where('estExpire', 0)
                ->get();

            return response()->json([
                'success' => true,
                'status_body' => 'Liste de tous les biens',
                'data' => BienRessource::collection($biens),
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des biens',
            ]);
        }
    }

    public function listeBiensTrouvesSansCategorie()
    {
        try {
            $biens = Bien::with(["images", 'categorie', 'user'])->where('statut', 'en attente')
                ->where('estExpire', 0)
                ->where('type_bien', 'bien trouve')
                ->get();

            return response()->json([
                'success' => true,
                'status_body' => 'Biens trouvés sans categorie',
                'data' => BienRessource::collection($biens),
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des biens ',
            ]);
        }
    }

    public function listeBiensPerdusSansCategorie()
    {
        try {
            $biens = Bien::with(["images", 'categorie', 'user'])->where('statut', 'en attente')
                ->where('estExpire', 0)
                ->where('type_bien', 'bien perdu')
                ->get();

            return response()->json([
                'success' => true,
                'status_body' => 'Biens perdus sans categorie',
                'data' => BienRessource::collection($biens),
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des biens',
            ]);
        }
    }



    public function index_perdu(Categorie $categorie)
    {
        try {
            $biens = Bien::with(["images", 'categorie', 'user'])->where('statut', 'en attente')
                ->where('categorie_id', $categorie->id)
                ->where('estExpire', 0)
                ->where('type_bien', 'bien perdu')
                ->get();

            return response()->json([
                'success' => true,
                'status_body' => 'Biens perdus acceptés',
                'data' => BienRessource::collection($biens),
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des biens perdus acceptés',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */

    public function store(RegisterBienRequest $request)
    {
        try {
            $bien = new Bien();

            $bien->libelle = $request->libelle;
            $bien->description = $request->description;
            $bien->date = $request->date;
            $bien->lieu = $request->lieu;
            $bien->type_bien = $request->type_bien;
            $bien->user_id = auth()->user()->id;
            $bien->categorie_id = $request->categorie_id;
  
            if ($request->hasFile('image')) {
                $bien->save();
                $imageFile = $request->file('image');
                $imageName = time() . '_' . $imageFile->getClientOriginalName();
                $imageFile->move(public_path('/imagesBiens'), $imageName);

                $image = new Image();
                $image->image = $imageName;
                $image->bien_id = $bien->id;
                $image->save();
                return response()->json([
                    'message' => "Bien enregistré avec succès",
                    'bien' => $bien,
                    'images' => $image,
                ], 201);
            } else {
                $bien->save();
                return response()->json([
                    'message' => "Bien enregistré avec succès",
                    'bien' => $bien
                ], 201);

            }

        }

        // foreach ($request->file('image') as $file) {
        //     $images = new Image();
        //     $imageName = time().'_'.$file->getClientOriginalName();
        //     $file-> move(public_path('/imagesBiens'), $imageName);
        //     $images->image = $imageName;
        //     $images->bien_id = $bien->id;
        //     $images->save();
        //     $imagesData[] = $images;
        // }
        // if (count($imagesData) > 0) {
        //     return response()->json([
        //         'message' => "Bien enregistré avec succès",
        //         'bien' => $bien,
        //         'images' => $imagesData,
        //     ]);
        // } else {
        //     return response()->json([
        //         'status_code' => 500,
        //         'status_message' => 'Erreur lors de l\'ajout des images du bien',
        //     ]);
        // }
        catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 422,
                'status_message' => 'Erreur lors de l\'ajout du bien',
                // 'image' => $imagesData
            ], 422);
        }
    }

    private function storeImage($image)
    {
        return $image->store('imageBien', 'public');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bien $bien)
    {
        $r = $bien->with(['images', 'categorie', 'user'])->first();
        try {

            return response()->json([
                'success' => true,
                'data' => new BienRessource($r),
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 404, // Not Found
                'status_message' => 'Bien non trouvé',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBienRequest $request, $id)
    {
        try {
            $bien = Bien::findOrFail($id);

            if ($bien->user_id === auth()->user()->id) {
                $bien->update($request->only(['libelle', 'description', 'date', 'lieu', 'categorie_id', 'type_bien']));

                if ($request->hasFile('image')) {
                    $bien->images()->delete();

                    $image = new Image();
                    $imageFile = $request->file('image');
                    $imageName = time() . '_' . $imageFile->getClientOriginalName();
                    $imageFile->move(public_path('/imagesBiens'), $imageName);
                    $image->image = $imageName;
                    $image->bien_id = $bien->id;
                    $image->save();
                }
                $r = $bien->load(['images', 'categorie', 'user']);

                return response()->json([
                    'success' => true,
                    'status_body' => 'bien modifié avec succes',
                    'data' => new BienRessource($r),
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Vous n\'êtes pas autorisé à effectuer cette opération.',
                ], 403);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 422,
                'status_message' => 'Erreur lors de la mise à jour du bien',
            ], 422);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bien $bien)
    {
        try {

            $bien->delete();

            return response()->json([
                'status_code' => 204,
                'status_message' => 'Bien supprimé avec succès',
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 404, // Not Found
                'status_message' => 'Bien non trouvé ou erreur lors de la suppression',
            ], 404);
        }
    }

    // public function acceptBien(Bien $bien)
    // {
    //     $bien->statut = 'accepte';
    //     $bien->update();
    //     return response()->json([
    //         'status code' => 200,
    //         'status message' => "La publication du bien a été accepté",
    //     ]);
    // }

    public function refuseBien(Bien $bien)
    {
        $bien->statut = 'refuse';
        $bien->update();
        return response()->json([
            'status code' => 200,
            'status message' => "La publication du bien a été refusé",
        ], 200);
    }
    public function bienUser()
    {
        $biens = Bien::with(["images", 'categorie', 'user'])
            ->where('user_id', auth()->user()->id)
            ->where('statut', 'en attente')
            ->where('type_bien', 'bien trouve')
            ->where('estExpire', 0)
            ->get();

        return response()->json([
            'success' => true,
            'status_body' => 'les biens trouvés de l\'utilisateur',
            'data' => BienRessource::collection($biens),
        ], 200);
    }

    public function bienUserPerdu()
    {
        $biens = Bien::with(["images", 'categorie', 'user'])
            ->where('user_id', auth()->user()->id)
            ->where('statut', 'en attente')
            ->where('type_bien', 'bien perdu')
            ->where('estExpire', 0)
            ->get();

        return response()->json([
            'success' => true,
            'status_body' => 'les biens perdus de l\'utilisateur',
            'data' => BienRessource::collection($biens),
        ], 200);
    }

    // public function rendreBien(Bien $bien)
    // {
    //     if (auth()->user()->id === $bien->user_id) {
    //         $bien->rendu = 1;
    //         $bien->save();
    //         return response()->json([
    //             'status code' => 200,
    //             'message' => "le bien à été marqué comme rendu.",
    //         ]);
    //     } else {
    //         return response()->json(['error' => 'Vous n\'êtes pas le propriétaire de ce bien']);
    //     }
    // }
}
