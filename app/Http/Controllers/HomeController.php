<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Question;

class HomeController extends Controller
{
    //
    public function index(Categorie $categorie){

        $questions = $categorie->questions->count() ?
            $categorie->questions()->paginate(10) : Question::latest()->paginate(10);

        $categories = Categorie::has('questions')->with('questions')->get();

        return view('home')->with([
            'questions' => $questions,
            'categories' => $categories
        ]);
    }
}
