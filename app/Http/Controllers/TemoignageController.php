<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistertemoignageRequest;
use Exception;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $temoignages = Temoignage::where('isAccepted',1);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Témoignages valides',
            'temoignages' => $temoignages,
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
    public function store(RegistertemoignageRequest $request)
    {
        $temoignage = new Temoignage();
        $temoignage->contenu = $request->contenu;
        $temoignage->user_id = auth()->user()->id;
        $temoignage->save(); 

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Témoignage enregistré avec succès',
            'publicite' => $temoignage,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Temoignage $temoignage)
    {
        return response()->json([
            'status_code' => 200,
            'status_message' => 'TDétail du temoignage',
            'publicite' => $temoignage,
        ]);   
    }

    public function accept(Temoignage $temoignage)
    {
        try {
            $temoignage->isAccepted = true;
            $temoignage->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => "Vous avez accepté ce temoignage"
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Temoignage $temoignage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Temoignage $temoignage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Temoignage $temoignage)
    {
        //
    }
}
