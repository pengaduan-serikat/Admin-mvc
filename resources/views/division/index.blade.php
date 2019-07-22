@extends('layouts.admin')

@section('content')
{{-- <h2>ini dari division index</h2> --}}
<h2><strong>Data Divisi:</strong></h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-md-12">
  <a class="btn btn-primary" href="/divisions/create">Add</a>
</div>
<table class="table" id="tableCat">
  <thead>
    <th width="10%">No.</th>
    <th width="75%">Name</th>
    <th>Action</th>
  </thead>
  <tbody>
    @if (count($divisions) > 0)
      @foreach ($divisions as $division)
        <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$division->name}}</td>
          <td><a href="/divisions/{{$division->id}}">Edit</a> | <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $division->id }}').submit();">Delete</a>
            <form action="/divisions/{{$division->id}}" method="POST" id="delete-form-{{ $division->id }}" style="display: none;">
              @csrf
              @method('DELETE')
              <input type="hidden" value="{{ $division->id }}" name="id">
           </form>
          </td>
        </tr>
      @endforeach
    @else
    <tr>
      <td colspan="3" align="center"> Tidak ada data</td>
    </tr>
    @endif
  </tbody>
</table>
<span>{{$divisions->links()}}</span>
@endsection