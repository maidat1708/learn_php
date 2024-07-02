@extends('layouts.base')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">IDCat</th>
        <th scope="col">Description</th>
        <th scope="col">Author</th>
        <th scope="col">Date</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->category_id }}</td>
            <td>{{ $article->description }}</td>
            <td>{{ $article->author->name }}</td>
            <td>{{ $article->date }}</td>
            <td>
                @if (!$trash)
                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                @else
                <a href="{{ route('articles.restore', $article->id) }}" class="btn btn-primary btn-sm">Restore</a>
                <form action="{{ route('articles.forcedelete', $article->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
    @if (!$trash)
        <a href="{{ route('articles.trash') }}" class="btn btn-primary btn-sm">Trash</a>
    @else
        <a href="{{ route('articles.index') }}" class="btn btn-primary btn-sm">Cancel</a>
    @endif
@endsection
