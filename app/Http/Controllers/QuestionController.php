<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Collective;
use App\Models\Commentaire;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified'])->except('show','voteUp','voteDown','getQuestionComments');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::where('user_id', auth()->user()->id)
            ->latest()->paginate(10);

        return view('questions.index')->with([
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Categorie::all();
        $collectives = Collective::all();

        return view('questions.create')->with([
            'collectives' => $collectives,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'titre' => 'required|min:10|unique:questions',
            'body' => 'required|min:10',
            'category_id' => 'required|numeric'
        ]);
        $data = $request -> except('_token');
        $data['user_id'] =auth()->user()->id;
        $data['slug'] = Str::slug($request->titre);
        Question::create($data);
        return redirect()->route('questions.index')->with([
            'success' => 'Question ajoutée avec succès.'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
        return view('questions.show')->with([
            'questions' => $question
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
        $categories = Categorie::all();
        $collectives = Collective::all();

        return view('questions.edit')->with([
            'collectives' => $collectives,
            'categories' => $categories,
            'questions' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
        if($question ->owner($question->user_id)){
            $this->validate($request,[
                'titre' => 'required|min:10|unique:questions,id,'.$question->id,
                'body' => 'required|min:10',
                'category_id' => 'required|numeric'
            ]);
            $data = $request -> except('_token','_method');
            $data['user_id'] =auth()->user()->id;
            $data['slug'] = Str::slug($request->titre);
            $question->update($data);
            return redirect()->route('questions.index')->with([
                'success' => 'Question mise à jour avec succès.'
            ]);
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
        if($question ->owner($question->user_id)){
            $question->delete();
            return redirect()->route('questions.index')->with([
                'success' => 'Question supprimé avec succès.'
            ]);
        }
        abort(403);
    }

    public function voteUp($id){
        $question = Question::find($id);
        $question-> increment('votes');
    }

    public function voteDown($id){
        $question = Question::find($id);
        $question-> decrement('votes');
    }

    public function getQuestionComments($id){

        $comments = Commentaire::where('question_id',$id)->with('user')->latest()->get();
        return response()->json($comments);
    }

}
