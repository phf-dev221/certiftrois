<?php

namespace App\Http\Controllers;

use App\Mail\News;
use App\Models\Souscris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SouscrisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Souscris= Souscris::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'liste souscriptions ',
            'souscriptions' =>  $Souscris
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

     
    public function store(Request $request)
    {
        $souscris = new Souscris();

        $souscris->email = $request->email;
        $souscris->save();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'souscription réussie',
            'souscription' => $souscris,
        ]);   
    }

    public function newsletter(Request $request)
    {
        $data = [
            'libelle' => $request->libelle,
            'contenu' => $request->contenu
        ];
    
        $users = Souscris::all();
        
        foreach ($users as $user) {
            Mail::to($user->email)->send(new News($data));

    }
    return view('newsletter',compact('data'));
}
    

    // public function sendNews(){
    //     $users = Souscris::all();

    //     foreach($users as $user){

    //         Mail::to($user->email)->send(new News());   
               
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(Souscris $souscris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Souscris $souscris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Souscris $souscris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Souscris $souscris)
    {
        //
    }
}
