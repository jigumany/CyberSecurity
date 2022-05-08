<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use App\Models\Module;
use Inertia\Inertia;

class ModuleController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Modules/Index', [
            'filters' => Request::all('search', 'trashed'),
            'modules' => Module::with('topics')->orderBy('name')
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($module) => [
                    'id' => $module->id,
                    'name' => $module->name,
                    'topics' => $module->topics,
                    'photo' => $module->photo_path ? URL::route('image', ['path' => $module->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
                    'deleted_at' => $module->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Modules/Create');
    }

    public function store()
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'description' => ['nullable'],
            'photo' => ['nullable', 'image'],
        ]);

        Module::create([
            'name' => Request::get('name'),
            'description' => Request::get('description'),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('modules') : null,
        ]);

        return Redirect::route('modules')->with('success', 'Module created.');
    }

    public function edit(Module $module)
    {
        return Inertia::render('Admin/Modules/Edit', [
            'module' => [
                'id' => $module->id,
                'name' => $module->name,
                'description' => $module->description,
                'topics' => $module->topics,
                'deleted_at' => $module->deleted_at,
                'photo' => $module->photo_path ? URL::route('image', ['path' => $module->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
            ],
        ]);
    }

    public function update(Module $module)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'description' => ['nullable'],
            'photo' => ['nullable', 'image'],
        ]);

        $module->update(Request::only('name', 'description'));

        if (Request::file('photo')) {
            $module->update(['photo_path' => Request::file('photo')->store('modules')]);
        }

        return Redirect::back()->with('success', 'Module updated.');
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return Redirect::back()->with('success', 'Module deleted.');
    }

    public function restore(Module $module)
    {
        $module->restore();

        return Redirect::back()->with('success', 'Module restored.');
    }
}
