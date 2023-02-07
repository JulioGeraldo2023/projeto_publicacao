@extends('layouts.main')

@section('title', 'Editando: ' . $publication->type)

@section('content')

<div id="publication-create-container" class="col-md-6 offset-md-3">
  <h1>Editando: {{ $publication->type }}</h1>
  <form action="/publications/update/{{ $publication->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="image">Imagem:</label>
      <input type="file" id="image" name="image" class="from-control-file">
      <img src="/img/publications/{{ $publication->image }}" alt="{{ $publication->type }}" class="img-preview">
    </div>
    <div class="form-group">
      <label for="title">Tipo:</label>
      <input type="text" class="form-control" id="type" name="type" placeholder="Tipo da publicação" value="{{ $publication->type }}">
    </div>
    <div class="form-group">
      <label for="date">Data:</label>
    <input type="date" class="form-control" id="date" name="date" value="{{ $publication->date->format('Y-m-d') }}">
    </div>
    <div class="form-group">
      <label for="title">Autor:</label>
      <input type="text" class="form-control" id="author" name="author" placeholder="Autor da publicação" value="{{ $publication->author }}">
    </div>
    <div class="form-group">
      <label for="title">Referencias:</label>
      <textarea name="reference" id="reference" class="form-control" placeholder="Referencias da publicação">{{ $publication->reference }}</textarea>
    </div>
    <div class="form-group">
      <label for="title">Itens:</label>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Link"> Link
      </div>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Brindes"> PDF
      </div>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Link"> Banner
      </div>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Brindes"> Imagem
      </div>
      <div class="form-group">	
        <input type="checkbox" name="items[]" value="Link"> Video
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Editar Publicação">
  </form>
</div>

@endsection