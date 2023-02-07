@extends('layouts.main')

@section('title', 'Projeto Publicações')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque por uma publicação</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="publications-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Publicações Cadastradas</h2>
    <p class="subtitle">Veja as publicações cadastradas</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($publications as $publication)
        <div class="card col-md-3">
            <img src="/img/publications/{{ $publication->image }}" alt="{{ $publication->type }}">
            <div class="card-body">
                <p class="card-date">{{ date('d/m/Y', strtotime($publication->date)) }}</p>
                <h5 class="card-title">{{ $publication->type }}</h5>
                <h6 class="card-title">{{ $publication->author }}</h6>
                <p class="card-participants">{{ count($publication->users) }} Participantes</p>
                <a href="/publications/{{ $publication->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
        @if(count($publications) == 0 && $search)
            <p>Não foi possível encontrar nenhuma publicação com {{ $search }}! <a href="/">Ver todos</a></p>
        @elseif(count($publications) == 0)
            <p>Não há publicações disponíveis</p>
        @endif
    </div>
</div>

@endsection