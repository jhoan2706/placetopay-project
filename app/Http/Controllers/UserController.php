<?php

namespace App\Http\Controllers;

use App\User;
use App\DocumentType;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Almacenar la informacion del Usuario
     *
     * @return view
     **/
    public function store(Request $request)
    {
        //obtengo el name de document_type
        $documentType = DocumentType::where('name', $request->document_type)->first();

        //verifico que usuario esté en la BD
        $user = User::where('email','=',$request->email)->first();
        
        //si el documento ingresado no coincide con el de la BD
        if ($user && $user->document!=$request->document) {
            return false;
        }

        //Si el cliente aún no esta registrado
        if (!$user) {
            $user = new User;

            $user->document = $request->document;
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->street = $request->street;

            $user->document_type()->associate($documentType->id);
            $user->save();

            //obtengo el id despues de guardar el cliente como usuario
            session(['user_id' => $user->id]);
        }
        return $user;
    }
}
