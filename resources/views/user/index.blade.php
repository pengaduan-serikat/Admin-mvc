@extends('layouts.admin')

@section('content')
{{-- <h2>ini dari user index</h2> --}}
<h2><strong>Data User:</strong></h2>
<div class="col-md-6">
  <a class="btn btn-primary" href="/users/create">Add</a>
</div>
<div class="col-md-3">

  <select class="form-control" name="filter" id="filter">
    <option value="0">All</option>
    @foreach ($data['access_types'] as $access_type)
      @if ($data['filter'] == $access_type->id)
        <option value="{{$access_type->id}}" selected>{{$access_type->name}}</option>
      @else
        <option value="{{$access_type->id}}">{{$access_type->name}}</option>
      @endif
    @endforeach
  </select>
</div>
<div class="col-md-3">
  {{-- <button type="submit" class="btn btn-primary">Filter</button> --}}
  <a class="btn btn-primary" onclick="window.location.replace(`/users?filter=`+document.getElementById('filter').value)">Add</a>
</div>
<table class="table" id="tableCat">
  <thead>
    <th width="10%">No.</th>
    <th>Nama</th>
    <th>Hak akses</th>
    <th>Posisi</th>
    <th>Divisi</th>
    <th>Action</th>
  </thead>
  <tbody>
    @if (count($data['users']) > 0)
      @foreach ($data['users'] as $user)
        <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$user->first_name.' '.$user->last_name}}</td>
          <td>{{$user->access_type}}</td>
          <td>
            @if ($user->position === null)
                -
            @else
              {{$user->position}}
            @endif
          </td>
          <td>{{$user->division}}</td>
          <td><a href="/users/{{$user->id}}">Edit</a>
            @if (Auth::user()->id !== $user->id)
            |
            {{-- delete user button --}}
            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">Delete</a>
            <form action="/users/{{$user->id}}" method="POST" id="delete-form-{{ $user->id }}" style="display: none;">
              @csrf
              @method('DELETE')
              <input type="hidden" value="{{ $user->id }}" name="id">
           </form>
           @endif
           {{-- delete user button --}}
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