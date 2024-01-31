<?php

namespace App\Http\Controllers;

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
            $biens = Bien::where('statut', 'accepte')
                ->where('categorie_id', $categorie->id)
                ->get();
            $result = [];
            foreach ($biens as $bien) {
                $firstimage = Image::where('bien_id', $bien->id)->first();
                $result[] = [
                    'categorie'=>$categorie->nom,
                    'bien' => $bien,
                    'premiere_image' => $firstimage,
                ];
            }

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Biens acceptés avec leur première image récupérés avec succès',
                'data' => $result,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des biens acceptés',
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

    public function store(RegisterBienRequest $request)
    {
        try {
            $bien = new Bien();

            $bien->libelle = $request->libelle;
            $bien->description = $request->description;
            $bien->date = $request->date;
            $bien->lieu = $request->lieu;
            $bien->user_id = auth()->user()->id;
            $bien->categorie_id = $request->categorie_id;
            $bien->save();
            $imagesData = [];

            foreach ($request->file('image') as $file) {
                $images = new Image();
                $imageName = time().'_'.$file->getClientOriginalName();
                $file-> move(public_path('/imagesBiens'), $imageName);
                $images->image = $imageName;
                $images->bien_id = $bien->id;
                $images->save();
                $imagesData[] = $images;
            }
            if (count($imagesData) > 0) {
                return response()->json([
                    'message' => "Bien enregistré avec succès",
                    'bien' => $bien,
                    'images' => $imagesData,
                ]);
            } else {
                return response()->json([
                    'status_code' => 500,
                    'status_message' => 'Erreur lors de l\'ajout des images du bien',
                ]);
            }

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de l\'ajout du bien',
                // 'image' => $imagesData
            ]);
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
        $images = Image::where('bien_id', $bien->id)->get();
        try {

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Bien récupéré avec succès',
                'bien' => $bien,
                'images' => $images
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 404, // Not Found
                'status_message' => 'Bien non trouvé',
            ]);
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
    public function update(UpdateBienRequest $request, $id)
    {
       
        try {
            $bien = Bien::findOrFail($id);

            if ($bien->user_id === auth()->user()->id) {
                $bien->update($request->only(['libelle', 'description', 'date', 'lieu', 'categorie_id']));

                if ($request->hasFile('image')) {
                    $bien->images()->delete();
                    foreach ($request->file('image') as $file) {
                        $images = new Image();
                        $imagePath = $file->store('images', 'public');
                        $images->image = $imagePath;
                        $images->bien_id = $bien->id;
                        $images->save();

                    }
                }

                return response()->json([
                    'message' => "Bien mis à jour avec succès",
                    'bien' => $bien,
                    'images' => $bien->images,
                ]);
            } else {
                return new JsonResponse('vous n\'etes pas autorisé a effectuer cette opération');
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la mise à jour du bien',
                'image' => $bien->images
            ]);
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
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 404, // Not Found
                'status_message' => 'Bien non trouvé ou erreur lors de la suppression',
            ]);
        }
    }

    public function acceptBien(Bien $bien)
    {
        $bien->statut = 'accepte';
        $bien->update();
        return response()->json([
            'status code' => 200,
            'status message' => "Le bien a été validé",
        ]);
    }

    public function refuseBien(Bien $bien)
    {
        $bien->statut = 'refuse';
        $bien->update();
        return response()->json([
            'status code' => 200,
            'status message' => "Le bien a été refusé",
        ]);
    }

    public function bienUser()
    {
        $biens = Bien::where('user_id', auth()->user()->id)
            ->where('rendu', 0)
            ->where('statut', 'accepte')
            ->get();

        $result = [];
        foreach ($biens as $bien) {
            $firstimage = Image::where('bien_id', $bien->id)->first();
            $result[] = [
                'bien' => $bien,
                'premiere_image' => $firstimage,
            ];
        }
        return response()->json([
            'status code' => 200,
            'biens' => $result,
            'status message' => "Liste des biens de l'utilisateur",
        ]);
    }

    public function rendreBien(Bien $bien){
        if(auth()->user()->id===$bien->user_id){
            $bien->rendu=1;
            $bien->save();
            return response()->json([
                'status code'=>200,
                'message'=>"le bien à été marqué comme rendu.",
                ]);
        }else{
            return response()->json(['error'=>'Vous n\'êtes pas le propriétaire de ce bien']);
        }
    }
}
