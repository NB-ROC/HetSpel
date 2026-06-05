<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpelController extends Controller
{

        public function index()
    {
        $producten = Product::all();

        return view('producten.index', compact('producten'));
    }

    public function spelSpelen()
    {
        //$spel = Spel::get($id);
        return view('game.resultaat');
    }

    public function timpost()
    {

        return view('tim');
    }
}
