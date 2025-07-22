@extends('layouts.app')

@section('title', isset($usefulLink) ? 'Editar Link' : 'Criar Link')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ isset($usefulLink) ? 'Editar Link' : 'Criar Novo Link' }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ isset($usefulLink) ? route('useful-links.update', $usefulLink->id) : route('useful-links.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($usefulLink))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="section_id" class="form-label">Seção</label>
                    <select class="form-select" id="section_id" name="section_id" required>
                        <option value="">Selecione uma seção</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ old('section_id', $usefulLink->section_id ?? '') == $section->id ? 'selected' : '' }}>
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nome do Link</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $usefulLink->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" class="form-control" id="url" name="url" 
                           value="{{ old('url', $usefulLink->url ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Imagem (opcional)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    
                    @if(isset($usefulLink) && $usefulLink->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $usefulLink->image) }}" alt="Imagem atual" width="100" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($usefulLink) ? 'Atualizar' : 'Salvar' }}
                </button>
                <a href="{{ route('useful-links.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection