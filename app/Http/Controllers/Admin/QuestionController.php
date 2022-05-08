<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use App\Models\Question;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Questions/Index', [
        'filters' => Request::all('search', 'trashed'),
        'questions' => Question::orderBy('id')
            ->filter(Request::only('search', 'trashed'))
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($question) => [
                'id' => $question->id,
                'content' => $question->content,
                'answer1' => $question->answer1,
                'answer2' => $question->answer2,
                'answer3' => $question->answer3,
                'answer4' => $question->answer4,
                'correct_answer' => $question->correct_answer,
                'deleted_at' => $question->deleted_at,
            ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Questions/Create');
    }

     public function store()
    {
        Request::validate([
            'content' => ['required', 'max:65535'],
            'answer1' => ['required', 'max:255'],
            'answer2' => ['required', 'max:255'],
            'answer3' => ['required', 'max:255'],
            'answer4' => ['required', 'max:255'],
            'correct_answer' => ['required', 'max:7'],
        ]);

        Question::create([
            'topic_id' => 1,
            'content' => Request::get('content'),
            'answer1' => Request::get('answer1'),
            'answer2' => Request::get('answer2'),
            'answer3' => Request::get('answer3'),
            'answer4' => Request::get('answer4'),
            'correct_answer' => Request::get('correct_answer'),
        ]);

        return Redirect::route('questions')->with('success', 'Question created.');
    }

    public function edit(Question $question)
    {
        return Inertia::render('Admin/Questions/Edit', [
            'question' => [
                'id' => $question->id,
                'content' => $question->content,
                'answer1' => $question->answer1,
                'answer2' => $question->answer2,
                'answer3' => $question->answer3,
                'answer4' => $question->answer4,
                'correct_answer' => $question->correct_answer,
                'deleted_at' => $question->deleted_at,
            ],
        ]);
    }

    public function update(Question $question)
    {
        Request::validate([
            'content' => ['required', 'max:65535'],
            'answer1' => ['required', 'max:255'],
            'answer2' => ['required', 'max:255'],
            'answer3' => ['required', 'max:255'],
            'answer4' => ['required', 'max:255'],
            'correct_answer' => ['required', 'max:7'],
        ]);

        $question->update(Request::only('content', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer'));

        return Redirect::back()->with('success', 'Question updated.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return Redirect::back()->with('success', 'Question deleted.');
    }

    public function restore(Question $question)
    {
        $question->restore();

        return Redirect::back()->with('success', 'Question restored.');
    }
}
