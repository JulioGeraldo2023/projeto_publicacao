@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas Publicações</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-publications-container">
    @if(count($publications) > 0)
    @else
    <p>Você ainda não tem publicações, <a href="/publications/create">criar publicação</a></p>
    @endif
</div>

@endsection