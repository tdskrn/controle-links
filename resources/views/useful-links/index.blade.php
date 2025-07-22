@extends('layouts.app')

@section('title', 'Links Úteis')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Links Úteis</h1>
        <a href="{{ route('useful-links.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Novo Link
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>URL</th>
                        <th>Seção</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td>
                                @if($link->image)
                                    <img src="{{ $link->image }}" alt="{{ $link->name }}" width="40" height="40" class="rounded" style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="bi bi-link text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $link->name }}</td>
                            <td>
                                <a href="{{ $link->url }}" target="_blank">{{ Str::limit($link->url, 30) }}</a>
                            </td>
                            <td>{{ $link->section->name }}</td>
                            <td>
                                <a href="{{ route('useful-links.edit', $link->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('useful-links.destroy', $link->id) }}" method="POST" class="d-inline">
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