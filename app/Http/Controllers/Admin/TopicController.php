<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use App\Models\Topic;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Topics/Index', [
        'filters' => Request::all('search', 'trashed'),
        'topics' => Topic::with('questions')
            ->orderBy('name')
            ->filter(Request::only('search', 'trashed'))
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($topic) => [
                'id' => $topic->id,
                'name' => $topic->name,
                'photo' => $topic->photo_path ? URL::route('image', ['path' => $topic->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
                'questions' => $topic->questions ? $topic->questions : null,
                'deleted_at' => $topic->deleted_at,
            ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Topics/Create');
    }

    public function store()
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'description' => ['nullable'],
            'photo' => ['nullable', 'image'],
        ]);

        Topic::create([
            'name' => Request::get('name'),
            'description' => Request::get('description'),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('topics') : null,
        ]);

        return Redirect::route('topics')->with('success', 'Topic created.');
    }
}
