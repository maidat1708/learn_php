@extends('layouts.base')

@section('content')
    <div class="container">
        <h2>Edit Article</h2>
        <form method="POST" action="{{ route('articles.update', $article->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
            </div>
            <div class="form-group">
                <label for="idCat">Category ID</label>
                <input type="text" class="form-control" id="idCat" name="idCat" value="{{ $article->idCat }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $article->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="idAu">Author ID</label>
                <input type="text" class="form-control" id="idAu" name="idAu" value="{{ $article->idAu }}">
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="datetime-local" class="form-control" id="date" name="date" value="{{ $article->date }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
