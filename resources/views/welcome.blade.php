@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section mb-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">
                    Bem-vindo ao seu <span class="text-gradient">Dashboard de Links</span>
                </h1>
                <p class="lead text-secondary mb-4">
                    Gerencie todos os seus links úteis de forma organizada e moderna. Acesse rapidamente seus recursos favoritos.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('useful-links.create') }}" class="btn btn-primary-custom">
                        <i class="bi bi-plus-circle me-2"></i>Novo Link
                    </a>
                    <a href="{{ route('sections.create') }}" class="btn btn-secondary-custom">
                        <i class="bi bi-folder-plus me-2"></i>Nova Seção
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="hero-icon">
                    <i class="bi bi-link-45deg" style="font-size: 8rem; background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-5">
        <div class="col-md-6 mb-3">
            <div class="card-custom p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper me-3" style="width: 60px; height: 60px; background: var(--gradient-primary); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-link text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">{{ $sections->sum(fn($section) => $section->links->count()) }}</h3>
                        <p class="text-secondary mb-0">Total de Links</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card-custom p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper me-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-folder text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">{{ $sections->count() }}</h3>
                        <p class="text-secondary mb-0">Seções Criadas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sections Grid -->
    <div class="row">
        @forelse($sections as $section)
            <div class="col-xl-4 col-lg-6 mb-4">
                <div class="card-custom">
                    <div class="card-header" style="background: var(--gradient-primary); padding: 1.5rem; border: none;">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 text-white fw-bold">
                                <i class="bi bi-folder me-2"></i>{{ $section->name }}
                            </h5>
                            <span class="badge" style="background: rgba(255,255,255,0.2); color: white;">
                                {{ $section->links->count() }} links
                            </span>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1.5rem;">
                        @forelse($section->links as $link)
                            <a href="{{ $link->url }}" target="_blank" class="link-item d-flex align-items-center p-3 mb-2 rounded text-decoration-none" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;">
                                <div class="link-image me-3">
                                    @if($link->image)
                                        <img src="{{ $link->image }}" 
                                             alt="{{ $link->name }}" 
                                             class="rounded" 
                                             width="45" 
                                             height="45"
                                             style="object-fit: cover; border: 2px solid rgba(255,255,255,0.1);">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center rounded" style="width: 45px; height: 45px; background: var(--gradient-primary);">
                                            <i class="bi bi-link text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 text-white">{{ $link->name }}</h6>
                                    <small class="text-secondary">{{ parse_url($link->url, PHP_URL_HOST) }}</small>
                                </div>
                                <i class="bi bi-arrow-up-right text-secondary"></i>
                            </a>
                        @empty
                            <div class="text-center py-4">
                                <i class="bi bi-inbox text-secondary" style="font-size: 3rem;"></i>
                                <p class="text-secondary mt-2 mb-0">Nenhum link nesta seção</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-folder-x text-secondary" style="font-size: 4rem;"></i>
                    <h3 class="mt-3 mb-2 text-white">Nenhuma seção encontrada</h3>
                    <p class="text-secondary mb-4">Comece criando sua primeira seção para organizar seus links.</p>
                    <a href="{{ route('sections.create') }}" class="btn btn-primary-custom">
                        <i class="bi bi-folder-plus me-2"></i>Criar Primeira Seção
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    @push('styles')
    <style>
        .link-item:hover {
            background: rgba(255,255,255,0.1) !important;
            border-color: rgba(255,255,255,0.2) !important;
            transform: translateY(-2px);
        }

        .hero-section {
            padding: 3rem 0;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
                text-align: center;
            }
            
            .hero-icon {
                margin-top: 2rem;
            }
        }
    </style>
    @endpush
@endsection