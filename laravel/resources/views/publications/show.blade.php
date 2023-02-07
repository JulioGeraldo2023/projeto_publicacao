@extends('layouts.main')

@section('title', $publication->type)

@section('content')

  <div class="col-md-10 offset-md-1">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <img src="/img/publications/{{ $publication->image }}" class="img-fluid" alt="{{  $publication->type }}">
      </div>
      <div id="info-container" class="col-md-6">
        <h1>{{  $publication->type }}</h1>
        <p class="publication-date"><ion-icon name="calendar-outline"></ion-icon> {{ $publication->date }}</p>
        <p class="publications-participants"><ion-icon name="people-outline"></ion-icon> {{ count($publication->users) }} Participantes</p>
        <p class="publication-owner"><ion-icon name="star-outline"></ion-icon> {{ $publicationOwner['name'] }}</p>
        @if(!$hasUserJoined)
          <form action="/publications/join/{{ $publication->id }}" method="POST">
            @csrf
            <a href="/publications/join/{{ $publication->id }}" 
              class="btn btn-primary" 
              id="publication-submit"
              onclick="publication.preventDefault();
              this.closest('form').submit();">
              Confirmar Presença
            </a>
          </form>
        @else
          <p class="already-joined-msg">Você já está participando desta Publicação!</p>
        @endif
        <h3>A publicação conta com:</h3>
        <ul id="items-list">
        @foreach($publication->items as $item)
          <li><ion-icon name="play-outline"></ion-icon><span>{{ $item }}</span></li>
        @endforeach
        </ul>
      </div>
      <div class="col-md-12" id="reference-container">
        <h3>Sobre a publicação:</h3>
        <p class="publication-reference">{{ $publication->reference }}</p>
      </div>
    </div>
  </div>

@endsection