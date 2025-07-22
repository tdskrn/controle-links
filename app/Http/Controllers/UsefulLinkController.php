<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\UsefulLink;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'controle-links',
                'public_id' => 'link_' . time(),
                'transformation' => [
                    'width' => 400,
                    'height' => 400,
                    'crop' => 'limit'
                ]
            ]);
            
            $data['image'] = $uploadedFile->getSecurePath();
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
        if ($request->has('remove_image') && $usefulLink->image) {
            $this->deleteCloudinaryImage($usefulLink->image);
            $data['image'] = null;
        }

        // Atualizar imagem se fornecida
        if ($request->hasFile('image')) {
            // Remove a imagem antiga se existir
            if ($usefulLink->image) {
                $this->deleteCloudinaryImage($usefulLink->image);
            }
            
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'controle-links',
                'public_id' => 'link_' . time(),
                'transformation' => [
                    'width' => 400,
                    'height' => 400,
                    'crop' => 'limit'
                ]
            ]);
            
            $data['image'] = $uploadedFile->getSecurePath();
        }

        $usefulLink->update($data);

        return redirect()->route('useful-links.index')
            ->with('success', 'Link atualizado com sucesso!');
    }

    public function destroy(UsefulLink $usefulLink)
    {
        if ($usefulLink->image) {
            $this->deleteCloudinaryImage($usefulLink->image);
        }

        $usefulLink->delete();

        return redirect()->route('useful-links.index')
            ->with('success', 'Link removido com sucesso!');
    }

    /**
     * Delete image from Cloudinary
     */
    protected function deleteCloudinaryImage($imageUrl)
    {
        try {
            $publicId = $this->extractPublicIdFromUrl($imageUrl);
            Cloudinary::destroy($publicId);
        } catch (\Exception $e) {
            \Log::error("Failed to delete Cloudinary image: " . $e->getMessage());
        }
    }

    /**
     * Extract public ID from Cloudinary URL
     */
    protected function extractPublicIdFromUrl($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        $parts = explode('/', $path);
        $publicIdWithExtension = end($parts);
        
        // Remove a extensão do arquivo
        return pathinfo($publicIdWithExtension, PATHINFO_FILENAME);
    }
}