@extends('layouts.app')

@section('title', 'Seções')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Seções</h1>
        <a href="{{ route('sections.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Nova Seção
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Slug</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sections as $section)
                        <tr>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->slug }}</td>
                            <td>
                                <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('sections.destroy', $section->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection