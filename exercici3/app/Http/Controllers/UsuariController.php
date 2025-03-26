<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;

// Importa la clase DB per poder realitzar els métodes put, post y delete
use Illuminate\Support\Facades\DB; 



class UsuariController extends Controller
{
    public function getUsers()
    {
        $usuaris = Usuari::all();

        return view('index', compact('usuaris'));
    }

    public function putUsers(Request $request,$id)
    {
        $usuari = Usuari::find($id);

        //validem amb validator
        $request->validate([

            //en aquest cas las variables no han de ser obligatories ni uniques
            'nom' => 'string|max:255', 
            'email' => 'email|',  // Afeguim mail únic
            'edat' => 'numeric|min:1',  // Indiquem que el valor mínim ha de ser 1, perque sempre sigui un valor positiu
        ]);


        //busquem a l'usuari
        $usuari = Usuari::find($id);

        //en cas que existeixi, actualitzem l'informació ambb Eloquent
        if($usuari){
             $usuari-> update([
                'nom' => $request->input('nom'),
                'email' => $request->input('email'),
                'edat' => $request->input('edat')
            ]);

            //rediriguim a la ruta, per poguer mantenir el missatge de succes o error
           return redirect()->route('putUsuaris')->with('success',"Usuari actualitzat correctament.");
       }

        return redirect()->route('putUsuaris')->with('error',"L'usuari no s'ha pogut actualitzar.");
       
    }

    public function postUsers(Request $request)
    {
        //validem amb validator
        $request->validate([

            //definim totes les variables com requerides y el tipus de data
            'nom' => 'required|string|max:255', 
            'email' => 'required|email|unique:usuaris,email',  // Afeguim mail únic
            'edat' => 'required|numeric|min:1',  // Indiquem que el valor mínim ha de ser 1, perque sempre sigui un valor positiu
        ]);


        //Creem el nou usuari amb Eloquent
        $newUser = Usuari::create([
            'nom' => $request->input('nom'),
            'email' => $request->input('email'),
            'edat' => $request->input('edat')
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

        //busquem a l'usuari
        $usuari = Usuari::find($id);

        //si l'usuari existeix, l'eliminem y redirigim
        if($usuari)
        {
            $usuari->delete();
            return redirect()->route('deleteUsuaris')->with('success',"Usuari eliminat correctament.");
        }

        return redirect()->route('deleteUsuaris')->with('error',"L'usuari no s'ha pogut eliminar.");

    }
}
