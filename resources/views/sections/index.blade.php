@extends('layouts.app')

@section('title', 'Gerenciar Seções')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="text-gradient mb-2">Gerenciar Seções</h1>
            <p class="text-secondary">Organize seus links em categorias temáticas</p>
        </div>
        <a href="{{ route('sections.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-folder-plus me-2"></i>Nova Seção
        </a>
    </div>

    @if($sections->count() > 0)
        <div class="row">
            @foreach($sections as $section)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card-custom p-4">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <div class="section-icon me-3">
                                    <div class="d-flex align-items-center justify-content-center rounded" style="width: 50px; height: 50px; background: var(--gradient-primary);">
                                        <i class="bi bi-folder text-white" style="font-size: 1.2rem;"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="text-white mb-1">{{ $section->name }}</h5>
                                    <p class="text-secondary mb-0">
                                        <small><i class="bi bi-tag me-1"></i>{{ $section->slug }}</small>
                                    </p>
                                </div>
                            </div>
                            <span class="badge" style="background: rgba(59, 130, 246, 0.2); color: var(--accent-blue);">
                                {{ $section->links->count() }} links
                            </span>
                        </div>
                        
                        <div class="section-links mb-3">
                            @if($section->links->count() > 0)
                                <div class="text-secondary mb-2">
                                    <small>Links nesta seção:</small>
                                </div>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($section->links->take(3) as $link)
                                        <span class="badge" style="background: rgba(255, 255, 255, 0.1); color: var(--text-secondary);">
                                            {{ Str::limit($link->name, 15) }}
                                        </span>
                                    @endforeach
                                    @if($section->links->count() > 3)
                                        <span class="badge" style="background: rgba(255, 255, 255, 0.1); color: var(--text-secondary);">
                                            +{{ $section->links->count() - 3 }} mais
                                        </span>
                                    @endif
                                </div>
                            @else
                                <div class="text-center py-2">
                                    <small class="text-secondary">Nenhum link adicionado</small>
                                </div>
                            @endif
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm flex-grow-1" style="background: rgba(251, 191, 36, 0.1); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3);">
                                <i class="bi bi-pencil me-1"></i>Editar
                            </a>
                            <form action="{{ route('sections.destroy', $section->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);" onclick="return confirm('Tem certeza que deseja excluir esta seção? Todos os links associados também serão removidos.')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-folder text-secondary" style="font-size: 4rem;"></i>
                <h3 class="mt-3 mb-2 text-white">Nenhuma seção encontrada</h3>
                <p class="text-secondary mb-4">Comece criando sua primeira seção para organizar seus links.</p>
                <a href="{{ route('sections.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-folder-plus me-2"></i>Criar Primeira Seção
                </a>
            </div>
        </div>
    @endif

    @push('styles')
    <style>
        .card-custom {
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-3px);
        }

        .empty-state {
            padding: 3rem 0;
        }
    </style>
    @endpush
@endsection