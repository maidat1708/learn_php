@extends('layouts.base')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Imgae</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $authors as $author )
          <tr>
            <td>{{ $author->id }} </td>
            <td><a href="{{ route('authors.show',$author->id) }}">{{ $author->name }}</a> </td>
            <td><img src="{{ $author->image }}" alt=""></td>
            <td>
                <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
@endsection
