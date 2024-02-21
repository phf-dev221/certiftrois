<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\PayeMail;
use App\Models\Demande;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UpdateDemandeRequest;
use App\Http\Requests\RegisterDemandeRequest;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $publicites = Demande::where('etat', 'en attente')->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des demandes en attente',
                'publicites' => $publicites,
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des publicites',
            ],500);
        }
    }

    public function pubPayes()
    {
        try {
            $publicites = Demande::where('estPaye', 1)->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des demandes de publicités payées',
                'publicites' => $publicites,
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des publicites',
            ],500);
        }
    }

    public function pubAffichable()
    {
        try {
            $publicites = Demande::where('estValide', 1)->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des demandes de publicités a afficher',
                'publicites' => $publicites,
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des publicites',
            ],500);
        }
    }

//     public function indexUser(){
//         $user = User::find(auth()->id());
//         if (!$user){
//             return response()->json(['error'=>"Utilisateur inconnu"],401);
//             }else{
//                 $demandes=Demande::where("user_id",$user->id)->orderByDesc('created_at')->get();
//                 return response()->json([
//                     'status_code' => 200,
//                     'status_message' => 'Liste des demandes de l\'utilisateur',
//                     'demandes' => $demandes,
//                 ]);
//     }
// }

    public function accept(Demande $demande)
    {
        $number = $demande->id;
            $demande->update([
                'etat' => 'accepte'
            ]); 
            Mail::to($demande->email)->send(new PayeMail($number));
            return response()->json([
                'status_code' => 200,
                'status_message' => "Vous avez accepté cette publicite"
            ],200);
    }

    public function refuse(Demande $demande)
    {
        try {
            $demande->update([
                'etat' => 'refuse'
            ]);
            $demande->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Vous avez refusé cette publicite"
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function acceptedDemande()
    {
        try {
            $publicites = Demande::where('etat', 'accepte')->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des publicites acceptées',
                'publicites' => $publicites,
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des publicites',
            ],500);
        }
    }

    public function refusedDemande()
    {
        try {
            $publicites = Demande::where('etat', 'refuse')->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des publicites refusées',
                'publicites' => $publicites,
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des publicites',
            ],500);
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
    public function store(RegisterDemandeRequest $request)
    {
        try {
            $demande = new Demande();

            $demande->date_debut = $request->date_debut;
            $demande->date_fin = $request->date_fin;
            $demande->details = $request->details;
            $demande->email = $request->email;
            $demande->nom = $request->nom;
            $demande->phone = $request->phone;
            if($request->image){
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('/imagesPubs'), $imageName);
            $demande->image = $imageName;
            }
            $demande->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'publicité approuvée',
                'publicite' => $demande,
            ],201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de l\'ajout de la publicité',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Demande $demande)
    {
        try {
            if ($demande) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'publicité trouvée',
                    'publicite' => $demande,
                ],200);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 404,
                'status_message' => 'publicite non trouvée',
            ],500);
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
    public function update(UpdateDemandeRequest $request, Demande $demande)
    {
        try {
            $demande->date_debut = $request->date_debut;
            $demande->date_fin = $request->date_fin;
            $demande->details = $request->details;
            $demande->email = $request->email;
            $demande->nom = $request->nom;
            $demande->phone = $request->phone;
            if($request->image){
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('/imagesPubs'), $imageName);
            $demande->image = $imageName;
            }
            $demande->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'publicité modifiée',
                'publicite' => $demande,
            ],200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        try {

            $demande->delete();
            return response()->json([
                'status_code' => 204,
                'status_message' => 'publicité supprimée avec succès',
            ],204);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la suppression de la publicité',
            ],500);
        }
    }
}
