<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\RegisterContactRequest;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts =  Contact::all();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'liste contacts',
            'contact' => $contacts,
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
    public function store(RegisterContactRequest $request)
    {
        $contact = new Contact();
        $contact->nom = $request->nom;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->user_id = auth()->user()->id;
        $contact->save();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'contact enregistré',
            'contact' => $contact,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return response()->json([
            'status_code' => 200,
            'status_message' => 'detail contact',
            'contact' => $contact,
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        try {
            $contact->update($request->only(['nom','email','message']));

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Informations contact mise à jour avec succès',
                '$contact' => $contact,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Informations contact supprimées avec succès',
            '$contact' => $contact,
        ]);

    }
}
