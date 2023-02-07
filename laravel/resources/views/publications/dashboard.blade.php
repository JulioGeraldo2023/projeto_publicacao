@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas Publicações</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-publications-container">
    @if(count($publications) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publications as $publication)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/publications/{{ $publication->id }}">{{ $publication->type }}</a></td>
                    <td>{{ count($publication->users) }}</td>
                    <td>
                        <a href="/publications/edit/{{ $publication->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a> 
                        <form action="/publications/{{ $publication->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    @else
    <p>Você ainda não tem publicações, <a href="/publications/create">criar publicação</a></p>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Publicações que estou participando</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-publications-container">
@if(count($publicationsasparticipant) > 0)
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Participantes</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($publicationsasparticipant as $publication)
            <tr>
                <td scropt="row">{{ $loop->index + 1 }}</td>
                <td><a href="/publications/{{ $publication->id }}">{{ $publication->type }}</a></td>
                <td>{{ count($publication->users) }}</td>
                <td>
                    <form action="/publications/leave/{{ $publication->id }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon> 
                            Sair da Publicação
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach    
    </tbody>
</table>
@else
<p>Você ainda não está participando de nenhuma publicação, <a href="/">veja todos as publicações</a></p>
@endif
</div>
@endsection
