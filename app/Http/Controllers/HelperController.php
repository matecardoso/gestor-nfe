<?php

namespace App\Http\Controllers;

class HelperController extends Controller
{
    public function getEstados() {

        return response()->json(estados());
    }

    public function getPaises() {
        
        return response()->json(paises());
    }
}
