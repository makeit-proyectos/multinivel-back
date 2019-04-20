<?php

namespace App\Http\Controllers;

use App\Referente;
use Illuminate\Http\Request;

class ReferentesController extends Controller
{
    //Buscar a un referente en especifico

    public function searchRef(Request $request)
    {
        //dpto|ciudad|barrio
            $referentes = Referente::select('*')
            ->where('referentes.codigo','=',$request->codigo)
            ->orwhere('referentes.nombre','=',$request->nombre)
            ->orwhere('referentes.apellido','=',$request->apellido)
            ->orwhere('referentes.departamento','=',$request->departamento)
            ->orwhere('referentes.ciudad','=',$request->ciudad)
            ->orwhere('referentes.barrio','=',$request->barrio)
            ->get();
            return response()->json($referentes);            
    }

    

}
