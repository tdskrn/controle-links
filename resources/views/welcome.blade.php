@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
    <div class="row">
        @foreach($sections as $section)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">{{ $section->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($section->links as $link)
                                <a href="{{ $link->url }}" target="_blank" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        @if($link->image)
                                            <img src="{{ $link->image }}" 
                                                 alt="{{ $link->name }}" 
                                                 class="rounded me-3" 
                                                 width="40" 
                                                 height="40"
                                                 style="object-fit: cover;"
                                                 onerror="this.onerror=null;this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjZTVlNWU1Ij48L3JlY3Q+PHRleHQgeD0iMjAiIHk9IjIwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGZpbGw9IiM2NjYiPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg';">
                                        @else
                                            <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="bi bi-link text-white"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $link->name }}</h6>
                                            <small class="text-muted">{{ parse_url($link->url, PHP_URL_HOST) }}</small>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection