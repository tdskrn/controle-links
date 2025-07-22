@extends('layouts.app')

@section('title', isset($section) ? 'Editar Seção' : 'Criar Seção')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ isset($section) ? 'Editar Seção' : 'Criar Nova Seção' }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ isset($section) ? route('sections.update', $section->id) : route('sections.store') }}" method="POST">
                @csrf
                @if(isset($section))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Nome da Seção</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $section->name ?? '') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($section) ? 'Atualizar' : 'Salvar' }}
                </button>
                <a href="{{ route('sections.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection