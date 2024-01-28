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
            $demandes = Demande::where('etat', 'en attente')->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des demandes en attente',
                'demandes' => $demandes,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des demandes',
            ]);
        }
    }

    public function indexUser(){
        $user = User::find(auth()->id());
        if (!$user){
            return response()->json(['error'=>"Utilisateur inconnu"],401);
            }else{
                $demandes=Demande::where("user_id",$user->id)->orderByDesc('created_at')->get();
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Liste des demandes de l\'utilisateur',
                    'demandes' => $demandes,
                ]);
    }
}

    public function accept(Demande $demande)
    {

        $user = User::where('id',$demande->user_id)->first();
        $number = $demande->id;
        // try {
            $demande->update([
                'etat' => 'accepte'
            ]);
            

            Mail::to($user->email)->send(new PayeMail($number));
            // };
            // return view('payement',compact('numero'));
            // Mail::to($user->email)->send(new PayeMail());   

        // } catch (Exception $e) {
        //     return response()->json($e);
        // }
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
                'status_message' => "Vous avez refusé cette demande"
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function acceptedDemande()
    {
        try {
            $demandes = Demande::where('etat', 'accepte')->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des demandes acceptées',
                'demandes' => $demandes,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des demandes',
            ]);
        }
    }

    public function refusedDemande()
    {
        try {
            $demandes = Demande::where('etat', 'refuse')->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Liste des demandes refusées',
                'demandes' => $demandes,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la récupération des demandes',
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
    public function store(RegisterDemandeRequest $request)
    {
        try {
            $demande = new Demande();

            $demande->duree = $request->duree;
            $demande->details = $request->details;
            $demande->email = $request->email;
            $demande->user_id = auth()->user()->id;
            $demande->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'Demande approuvée',
                'bien' => $demande,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de l\'ajout du bien',
            ]);
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
                    'status_message' => 'Demande trouvée',
                    'demande' => $demande,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 404,
                'status_message' => 'Demande non trouvée',
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
    public function update(UpdateDemandeRequest $request, Demande $demande)
    {
        try {
            $demande->update($request->only(['duree', 'details', 'email']));

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Informations utilisateur mises à jour avec succès',
                'demande' => $demande,
            ]);
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
                'status_code' => 200,
                'status_message' => 'Demande supprimée avec succès',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status_code' => 500,
                'status_message' => 'Erreur lors de la suppression de la demande',
            ]);
        }
    }
}
