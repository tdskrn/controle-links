<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        return view('sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sections,name'
        ]);

        Section::create($request->all());

        return redirect()->route('sections.index')
            ->with('success', 'Seção criada com sucesso!');
    }

    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sections,name,'.$section->id
        ]);

        $section->update($request->all());

        return redirect()->route('sections.index')
            ->with('success', 'Seção atualizada com sucesso!');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')
            ->with('success', 'Seção removida com sucesso!');
    }
}