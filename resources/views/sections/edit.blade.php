@extends('layouts.app')

@section('title', isset($section) ? 'Editar Seção' : 'Criar Seção')

@section('content')
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('sections.index') }}" style="color: var(--accent-blue);">Seções</a></li>
                <li class="breadcrumb-item active text-secondary">{{ isset($section) ? 'Editar' : 'Criar' }}</li>
            </ol>
        </nav>
        <h1 class="text-gradient mb-2">{{ isset($section) ? 'Editar Seção' : 'Criar Nova Seção' }}</h1>
        <p class="text-secondary">{{ isset($section) ? 'Atualize as informações da seção' : 'Crie uma nova categoria para organizar seus links' }}</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-custom p-4">
                <form action="{{ isset($section) ? route('sections.update', $section->id) : route('sections.store') }}" method="POST">
                    @csrf
                    @if(isset($section))
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label for="name" class="form-label text-white fw-semibold mb-2">
                            <i class="bi bi-folder me-2"></i>Nome da Seção
                        </label>
                        <input type="text" class="form-control form-control-custom" id="name" name="name" 
                               value="{{ old('name', $section->name ?? '') }}" required 
                               placeholder="Ex: Trabalho, Estudos, Entretenimento...">
                        <small class="text-secondary">O slug será gerado automaticamente baseado no nome</small>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-check-circle me-2"></i>{{ isset($section) ? 'Atualizar Seção' : 'Salvar Seção' }}
                        </button>
                        <a href="{{ route('sections.index') }}" class="btn btn-secondary-custom">
                            <i class="bi bi-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card-custom p-4">
                <h5 class="text-white mb-3">
                    <i class="bi bi-lightbulb me-2"></i>Dicas para Seções
                </h5>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Use nomes claros e descritivos</li>
                    <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Agrupe links por tema ou categoria</li>
                    <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Mantenha o número de seções organizado</li>
                    <li class="mb-0"><i class="bi bi-check text-success me-2"></i>Evite nomes muito longos</li>
                </ul>
                
                <div class="mt-4 p-3 rounded" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3);">
                    <h6 class="text-white mb-2">
                        <i class="bi bi-info-circle me-2"></i>Exemplos de Seções
                    </h6>
                    <div class="d-flex flex-wrap gap-1">
                        <span class="badge" style="background: rgba(255, 255, 255, 0.1); color: var(--text-secondary);">Trabalho</span>
                        <span class="badge" style="background: rgba(255, 255, 255, 0.1); color: var(--text-secondary);">Estudos</span>
                        <span class="badge" style="background: rgba(255, 255, 255, 0.1); color: var(--text-secondary);">Social</span>
                        <span class="badge" style="background: rgba(255, 255, 255, 0.1); color: var(--text-secondary);">Ferramentas</span>
                        <span class="badge" style="background: rgba(255, 255, 255, 0.1); color: var(--text-secondary);">Notícias</span>
                    </div>
                </div>
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

        .breadcrumb-item + .breadcrumb-item::before {
            color: var(--text-secondary);
        }
    </style>
    @endpush
@endsection