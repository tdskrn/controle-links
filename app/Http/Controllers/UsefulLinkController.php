<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class UsefulLinkController extends Controller
{
    public function index()
    {
        $links = UsefulLink::with('section')->get();
        return view('useful-links.index', compact('links'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('useful-links.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageData = file_get_contents($imageFile->getRealPath());
            $mimeType = $imageFile->getMimeType();
            $base64 = base64_encode($imageData);
            
            $data['image'] = 'data:' . $mimeType . ';base64,' . $base64;
        }

        UsefulLink::create($data);

        return redirect()->route('useful-links.index')
            ->with('success', 'Link criado com sucesso!');
    }

    public function edit(UsefulLink $usefulLink)
    {
        $sections = Section::all();
        return view('useful-links.edit', compact('usefulLink', 'sections'));
    }

    public function update(Request $request, UsefulLink $usefulLink)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean'
        ]);

        $data = $request->except('image', 'remove_image');

        // Remover imagem se solicitado
        if ($request->has('remove_image')) {
            $data['image'] = null;
        }

        // Atualizar imagem se fornecida
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageData = file_get_contents($imageFile->getRealPath());
            $mimeType = $imageFile->getMimeType();
            $base64 = base64_encode($imageData);
            
            $data['image'] = 'data:' . $mimeType . ';base64,' . $base64;
        }

        $usefulLink->update($data);

        return redirect()->route('useful-links.index')
            ->with('success', 'Link atualizado com sucesso!');
    }

    public function destroy(UsefulLink $usefulLink)
    {
        $usefulLink->delete();

        return redirect()->route('useful-links.index')
            ->with('success', 'Link removido com sucesso!');
    }
}