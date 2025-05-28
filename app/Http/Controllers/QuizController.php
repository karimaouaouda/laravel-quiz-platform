<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if( !Auth::user()->isStudent() ){
            return to_route('home')->with('status', 'you are not a student');
        }

        return view('quiz.index');
    }

    public function pass(Request $request){
        if( !$request->has('quiz') ){
            throw new NotFoundHttpException();
        }

        if (! $request->has('code')){
            return view('quiz.code', [
                'quiz_id' => $request->get('quiz')
            ]);
        }

        $quiz = Quiz::findOrFail($request->input('quiz'));
        try{
            $code = Crypt::decrypt($request->input('code'));
        }catch(\Exception $e){
            throw new NotFoundHttpException('the code you entered is not correct');
        }
        if( $quiz->code != $code ){
            throw new NotFoundHttpException('the code you entered is not correct');
        }

        return view('quiz.pass', compact('quiz'));
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
    public function store(StoreQuizRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        //
    }
}
