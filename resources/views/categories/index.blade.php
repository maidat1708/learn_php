@extends('layouts.base')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      @foreach ( $categories as $category )
          <tr>
            <td>{{ $category->id }} </td>
            <td>{{ $category->name }} </td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
