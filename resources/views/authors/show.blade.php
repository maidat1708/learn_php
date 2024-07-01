@extends('layouts.base')

@section('content')
    <h2>Show Author</h2>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $author->name }}" required>
    </div>
    <div class="form-group">
        <label for="image">Image URL</label>
        <input type="text" class="form-control" id="image" name="image" value="{{ $author->image }}" required>
    </div>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">IDCat</th>
            <th scope="col">Description</th>
            <th scope="col">IDAu</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->idCat }}</td>
                <td>{{ $article->description }}</td>
                <td>{{ $article->idAu }}</td>
                <td>{{ $article->date }}</td>
            </tr>
        @endforeach
        </tbody>
      </table>
@endsection
