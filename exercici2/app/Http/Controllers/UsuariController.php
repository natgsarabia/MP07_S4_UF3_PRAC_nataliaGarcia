<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;

// Importa la clase DB per poder realitzar els métodes put, post y delete
use Illuminate\Support\Facades\DB; 

// Afeguim les validacións Request que hem creat
use App\Http\Requests\StoreUsuariRequest;
use App\Http\Requests\UpdateUsuariRequest;

class UsuariController extends Controller
{
    public function getUsers()
    {
        $usuaris = Usuari::all();

        return view('index', compact('usuaris'));
    }

    public function putUsers(UpdateUsuariRequest $request,$id)
    {
        $usuari = Usuari::find($id);

        $nom = $request->input('nom');
        $email = $request->input('email');
        $edat = $request->input('edat');
        // echo "alert('id: $id datos: $nom y $mail y $edat');";


        //busquem a l'usuari
        $usuari = Usuari::find($id);

        // dd($usuari);

        //en cas que existeixi, actualitzem l'informació
        if($usuari)
        {   
            //només actualitzarem si es modifica alguna variable
            if($usuari->nom!=$nom) $usuari->nom=$nom;
            if($usuari->email=$email) $usuari->email=$email;
            if($usuari->edat=$edat) $usuari->edat=$edat;

            //guardem els canvis:
            $usuari->save();

            //rediriguim a la ruta, per poguer mantenir el missatge de succes o error
           return redirect()->route('putUsuaris')->with('success',"Usuari actualitzat correctament.");
       }

        return redirect()->route('putUsuaris')->with('error',"L'usuari no s'ha pogut actualitzar.");
       
    }

    public function postUsers(StoreUsuariRequest $request)
    {
        $nom = $request->input('nom');
        $mail = $request->input('email');
        $edat = $request->input('edat');

        $newUser = DB::table('usuaris')->insert([
            'nom' => $nom,
            'email' => $mail,
            'edat' => $edat
       ]);

       if($newUser)
       {
         return redirect()->route('postUsuaris')->with('success',"Usuari creat correctament.");
       }

       return redirect()->route('postUsuaris')->with('error',"L'usuari no s'ha pogut crear.");

       
    }

    public function deleteUsers(Request $request)
    {
        $id = $request->input('id');

        $deleteUser=DB::table('usuaris')
            ->where('id', $id)
            ->delete();

        //si es pot eliminar correctament, rediriguim
        if($deleteUser)
        {
            return redirect()->route('deleteUsuaris')->with('success',"Usuari eliminat correctament.");
        }

        return redirect()->route('deleteUsuaris')->with('error',"L'usuari no s'ha pogut eliminar.");

    }
}
