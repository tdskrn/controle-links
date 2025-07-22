@extends('layouts.app')

@section('title', isset($usefulLink) ? 'Editar Link' : 'Criar Link')

@section('content')
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('useful-links.index') }}" style="color: var(--accent-blue);">Links</a></li>
                <li class="breadcrumb-item active text-secondary">{{ isset($usefulLink) ? 'Editar' : 'Criar' }}</li>
            </ol>
        </nav>
        <h1 class="text-gradient mb-2">{{ isset($usefulLink) ? 'Editar Link' : 'Criar Novo Link' }}</h1>
        <p class="text-secondary">{{ isset($usefulLink) ? 'Atualize as informações do link' : 'Adicione um novo link útil à sua coleção' }}</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-custom p-4">
                <form action="{{ isset($usefulLink) ? route('useful-links.update', $usefulLink->id) : route('useful-links.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($usefulLink))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="section_id" class="form-label text-white fw-semibold mb-2">
                            <i class="bi bi-folder me-2"></i>Seção
                        </label>
                        <select class="form-select form-control-custom" id="section_id" name="section_id" required>
                            <option value="">Selecione uma seção</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id', $usefulLink->section_id ?? '') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="form-label text-white fw-semibold mb-2">
                            <i class="bi bi-tag me-2"></i>Nome do Link
                        </label>
                        <input type="text" class="form-control form-control-custom" id="name" name="name" 
                               value="{{ old('name', $usefulLink->name ?? '') }}" required 
                               placeholder="Ex: GitHub, Google Drive, Netflix...">
                    </div>

                    <div class="mb-4">
                        <label for="url" class="form-label text-white fw-semibold mb-2">
                            <i class="bi bi-link-45deg me-2"></i>URL
                        </label>
                        <input type="url" class="form-control form-control-custom" id="url" name="url" 
                               value="{{ old('url', $usefulLink->url ?? '') }}" required 
                               placeholder="https://exemplo.com">
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label text-white fw-semibold mb-2">
                            <i class="bi bi-image me-2"></i>Imagem (opcional)
                        </label>
                        <input type="file" class="form-control form-control-custom" id="image" name="image" accept="image/*">
                        <small class="text-secondary">Formatos aceitos: JPG, PNG, GIF (máx. 2MB)</small>
                        
                        @if(isset($usefulLink) && $usefulLink->image)
                            <div class="mt-3 d-flex align-items-center gap-3">
                                <div>
                                    <img src="{{ $usefulLink->image }}" alt="Imagem atual" width="80" height="80" class="rounded" style="object-fit: cover; border: 2px solid rgba(255,255,255,0.1);">
                                </div>
                                <div>
                                    <p class="text-white mb-1">Imagem atual</p>
                                    <label class="form-check">
                                        <input type="checkbox" name="remove_image" value="1" class="form-check-input">
                                        <span class="form-check-label text-secondary">Remover imagem</span>
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-check-circle me-2"></i>{{ isset($usefulLink) ? 'Atualizar Link' : 'Salvar Link' }}
                        </button>
                        <a href="{{ route('useful-links.index') }}" class="btn btn-secondary-custom">
                            <i class="bi bi-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card-custom p-4">
                <h5 class="text-white mb-3">
                    <i class="bi bi-lightbulb me-2"></i>Dicas
                </h5>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Use nomes descritivos para facilitar a busca</li>
                    <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Organize por seções temáticas</li>
                    <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Adicione imagens para identificação visual</li>
                    <li class="mb-0"><i class="bi bi-check text-success me-2"></i>Verifique se a URL está correta</li>
                </ul>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .form-control-custom {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: var(--text-primary) !important;
            border-radius: 8px !important;
            padding: 0.75rem !important;
            transition: all 0.3s ease !important;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: var(--accent-blue) !important;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25) !important;
            color: var(--text-primary) !important;
        }

        .form-control-custom::placeholder {
            color: var(--text-secondary) !important;
        }

        .form-control-custom option {
            background: var(--card-bg) !important;
            color: var(--text-primary) !important;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: var(--text-secondary);
        }
    </style>
    @endpush
@endsection