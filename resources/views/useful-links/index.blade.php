@extends('layouts.app')

@section('title', 'Gerenciar Links')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="text-gradient mb-2">Gerenciar Links</h1>
            <p class="text-secondary">Visualize e gerencie todos os seus links úteis</p>
        </div>
        <a href="{{ route('useful-links.create') }}" class="btn btn-primary-custom">
            <i class="bi bi-plus-circle me-2"></i>Novo Link
        </a>
    </div>

    @if($links->count() > 0)
        <div class="row">
            @foreach($links as $link)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card-custom p-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="link-image me-3">
                                @if($link->image)
                                    <img src="{{ $link->image }}" 
                                         alt="{{ $link->name }}" 
                                         class="rounded" 
                                         width="60" 
                                         height="60"
                                         style="object-fit: cover; border: 2px solid rgba(255,255,255,0.1);">
                                @else
                                    <div class="d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px; background: var(--gradient-primary);">
                                        <i class="bi bi-link text-white" style="font-size: 1.5rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="text-white mb-1">{{ $link->name }}</h5>
                                <p class="text-secondary mb-1">
                                    <i class="bi bi-folder me-1"></i>{{ $link->section->name }}
                                </p>
                                <a href="{{ $link->url }}" target="_blank" class="text-decoration-none" style="color: var(--accent-blue);">
                                    <small><i class="bi bi-link-45deg me-1"></i>{{ Str::limit($link->url, 35) }}</small>
                                </a>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ $link->url }}" target="_blank" class="btn btn-sm flex-grow-1" style="background: rgba(59, 130, 246, 0.1); color: var(--accent-blue); border: 1px solid rgba(59, 130, 246, 0.3);">
                                <i class="bi bi-box-arrow-up-right me-1"></i>Abrir
                            </a>
                            <a href="{{ route('useful-links.edit', $link->id) }}" class="btn btn-sm" style="background: rgba(251, 191, 36, 0.1); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3);">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('useful-links.destroy', $link->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);" onclick="return confirm('Tem certeza que deseja excluir este link?')">
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
                <i class="bi bi-link text-secondary" style="font-size: 4rem;"></i>
                <h3 class="mt-3 mb-2 text-white">Nenhum link encontrado</h3>
                <p class="text-secondary mb-4">Comece criando seu primeiro link útil.</p>
                <a href="{{ route('useful-links.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-circle me-2"></i>Criar Primeiro Link
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