@extends('layouts.app')

@section('title', 'Editar Link Útil')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Link: {{ $usefulLink->name }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('useful-links.update', $usefulLink->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="section_id" class="form-label">Seção</label>
                            <select class="form-select @error('section_id') is-invalid @enderror" 
                                    id="section_id" name="section_id" required>
                                <option value="">Selecione uma seção</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}" 
                                        {{ old('section_id', $usefulLink->section_id) == $section->id ? 'selected' : '' }}>
                                        {{ $section->name }}
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('section_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome do Link</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $usefulLink->name) }}" 
                                   required>
                            
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                   id="url" name="url" value="{{ old('url', $usefulLink->url) }}" 
                                   required>
                            
                            @error('url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagem (opcional)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if($usefulLink->image)
                                <div class="mt-3">
                                    <p>Imagem atual:</p>
                                    <img src="{{ asset('storage/' . $usefulLink->image) }}" 
                                         alt="{{ $usefulLink->name }}" 
                                         class="img-thumbnail" style="max-width: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" 
                                               id="remove_image" name="remove_image">
                                        <label class="form-check-label" for="remove_image">
                                            Remover imagem atual
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('useful-links.index') }}" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection