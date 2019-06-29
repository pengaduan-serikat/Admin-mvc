@extends('layouts.admin')

@section('content')
{{-- <h2>ini dari position index</h2> --}}
<h2><strong>Data Posisi:</strong></h2>
<div class="col-md-12">
  <a class="btn btn-primary" href="/positions/create">Add</a>
</div>
<table class="table" id="tableCat">
  <thead>
    <th width="10%">No.</th>
    <th width="75%">Name</th>
    <th>Action</th>
  </thead>
  <tbody>
    @if (count($positions) > 0)
      @foreach ($positions as $position)
        <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$position->name}}</td>
          <td><a href="/positions/{{$position->id}}">Edit</a> | <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $position->id }}').submit();">Delete</a>
            <form action="/positions/{{$position->id}}" method="POST" id="delete-form-{{ $position->id }}" style="display: none;">
              @csrf
              @method('DELETE')
              <input type="hidden" value="{{ $position->id }}" name="id">
           </form>
          </td>
        </tr>
      @endforeach
    @else
    <tr>
      <td colspan="3" align="center"> Tidak ada data posisi</td>
    </tr>
    @endif
  </tbody>
</table>
@endsection